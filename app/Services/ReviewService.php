<?php

namespace App\Services;

use App\Repositories\ReviewRepository;
use App\Models\TravelPackage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ReviewService
{
    public function __construct(
        protected ReviewRepository $reviewRepository
    ) {}

    // get all reviews for a package + calculated stats
    // packageId must exist — throw 404 if not
    public function getPackageReviews(int $packageId): array
    {
        // confirm package exists
        TravelPackage::findOrFail($packageId);

        $reviews = $this->reviewRepository->getByPackage($packageId);

        // calculate average rating from the collection
        // round to 1 decimal — e.g. 4.3, not 4.333333
        $averageRating = $reviews->count() > 0
            ? round($reviews->avg('rating'), 1)
            : null;

        return [
            'reviews'        => $reviews,
            'average_rating' => $averageRating,
            'total_reviews'  => $reviews->count(),
        ];
    }

    // create a review for a package
    // one review per user per package — enforced here + db unique constraint
    public function create(array $data, int $packageId, $user): \App\Models\Review
    {
        // confirm package exists
        TravelPackage::findOrFail($packageId);

        // check if user already reviewed this package
        if ($this->reviewRepository->existsByUser($user->id, $packageId)) {
            throw new \Exception('You have already reviewed this package.');
        }

        $review = $this->reviewRepository->create([
            'user_id'           => $user->id,
            'travel_package_id' => $packageId,
            'rating'            => $data['rating'],
            'comment'           => $data['comment'] ?? null,
        ]);

        // load user relationship so resource can include it
        $review->load('user');

        return $review;
    }

    // delete user's own review for a package
    public function delete(int $packageId, $user): void
    {
        $review = $this->reviewRepository->getByUserAndPackage(
            $user->id,
            $packageId
        );

        if (!$review) {
            throw new ModelNotFoundException('Review not found.');
        }

        $this->reviewRepository->delete($review);
    }
}