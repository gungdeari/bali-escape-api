<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\BookingService;
use App\Http\Resources\BookingResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\BookingRequest;
use App\Helpers\ApiResponse;
use App\Http\Requests\UpdateStatusBookingRequest;
use Illuminate\Http\Request;

class BookingApiController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function index(Request $request)
    {
        $bookings = $this->bookingService->getBookings($request->user());

        return ApiResponse::paginated(
            $bookings,
            BookingResource::collection($bookings),
            'Bookings retrieved successfully'
        );
    }

    public function store(BookingRequest $request)
    {
        try {
            $booking = $this->bookingService->create(
                $request->validated(),
                $request->user()
            );

            return ApiResponse::success(
                new BookingResource($booking),
                'Booking created successfully',
                201
            );

        } catch (\Exception $e) {
            return ApiResponse::error($e->getMessage(), 400);
        }
    }

    public function show(int $id)
    {
        try {
            $booking = $this->bookingService->getById($id);

            return ApiResponse::success(
                new BookingResource($booking),
                'Booking retrieved successfully'
            );

        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Booking not found', 404);
        }
    }

    public function updateStatus(UpdateStatusBookingRequest $request, int $id)
    {
        try {
            $booking = $this->bookingService->updateStatus(
                $id,
                $request->validated()['status']
            );

            return ApiResponse::success(
                new BookingResource($booking),
                'Booking status updated successfully'
            );

        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Booking not found', 404);

        } catch (\Exception $e) {
            return ApiResponse::error($e->getMessage(), 400);
        }
    }
}