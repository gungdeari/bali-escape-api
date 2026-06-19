<?php

namespace App\Repositories;

use App\Models\Payment;
use App\Models\Booking;

class PaymentRepository
{
    public function getAll()
    {
        return Payment::with([
                'booking.user',
                'booking.items.travelPackage'
            ])
            ->latest()
            ->paginate(10);
    }

    public function getByUser(int $userId)
    {
        return Payment::with([
                'booking.items.travelPackage'
            ])
            ->whereHas('booking', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->latest()
            ->paginate(10);
    }

    public function findBooking(int $id)
    {
        return Booking::with(['items'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return Payment::create($data);
    }

    public function updateBookingStatus(int $bookingId, string $status)
    {
        $booking = Booking::findOrFail($bookingId);
        $booking->update(['status' => $status]);

        return $booking;
    }

    public function findByIdWithRelations(int $id)
    {
        return Payment::with([
            'booking.user',
            'booking.items.travelPackage'
        ])->findOrFail($id);
    }
}