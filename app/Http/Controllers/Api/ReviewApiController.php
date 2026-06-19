<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ReviewService;
use App\Http\Resources\ReviewResource;
use App\Http\Requests\ReviewRequest;
use App\Helpers\ApiResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ReviewApiController extends Controller
{
    public function __construct(
        protected ReviewService $reviewService
    ) {}

    // GET /travel-packages/:packageId/reviews
    // public — anyone can read reviews, no auth needed
    public function index(int $packageId)
    {
        try {
            $data = $this->reviewService->getPackageReviews($packageId);

            return ApiResponse::success(
                [
                    'reviews'        => ReviewResource::collection($data['reviews']),
                    'average_rating' => $data['average_rating'],
                    'total_reviews'  => $data['total_reviews'],
                ],
                'Reviews retrieved successfully'
            );

        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Package not found', 404);
        }
    }

    // POST /travel-packages/:packageId/reviews
    // protected — must be logged in
    public function store(ReviewRequest $request, int $packageId)
    {
        try {
            $review = $this->reviewService->create(
                $request->validated(),
                $packageId,
                $request->user()
            );

            return ApiResponse::success(
                new ReviewResource($review),
                'Review submitted successfully',
                201
            );

        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Package not found', 404);

        } catch (\Exception $e) {
            return ApiResponse::error($e->getMessage(), 422);
        }
    }

    // DELETE /travel-packages/:packageId/reviews
    // protected — user can only delete their own review
    public function destroy(Request $request, int $packageId)
    {
        try {
            $this->reviewService->delete($packageId, $request->user());

            return ApiResponse::success(
                null,
                'Review deleted successfully'
            );

        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Review not found', 404);

        } catch (\Exception $e) {
            return ApiResponse::error($e->getMessage(), 400);
        }
    }
}