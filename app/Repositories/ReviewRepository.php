<?php

namespace App\Repositories;

use App\Models\Review;

class ReviewRepository
{
    // get all reviews for one package — newest first
    public function getByPackage(int $packageId)
    {
        return Review::with('user')
            ->where('travel_package_id', $packageId)
            ->latest()
            ->get();
    }

    // check if user already reviewed this package
    // used to prevent duplicate reviews
    public function existsByUser(int $userId, int $packageId): bool
    {
        return Review::where('user_id', $userId)
            ->where('travel_package_id', $packageId)
            ->exists();
    }

    // get one review by user + package
    // used for delete — user can only delete their own review
    public function getByUserAndPackage(int $userId, int $packageId): ?Review
    {
        return Review::where('user_id', $userId)
            ->where('travel_package_id', $packageId)
            ->first();
    }

    // create a new review
    public function create(array $data): Review
    {
        return Review::create($data);
    }

    // delete a review
    public function delete(Review $review): void
    {
        $review->delete();
    }
}