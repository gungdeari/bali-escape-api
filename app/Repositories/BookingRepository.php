<?php 

namespace App\Repositories;

use App\Models\Booking;
use App\Models\TravelPackage;
use App\Models\BookingItem;

class BookingRepository
{
    public function getAll()
    {
        return Booking::with([
            'user', 
            'items.travelPackage',
            'payment'
        ])->latest()->paginate(10);
    }

    public function getByUser(int $userId)
    {
        return Booking::with([
                'user',
                'items.travelPackage'
            ])
            ->where('user_id', $userId)
            ->latest()
            ->paginate(10);
    }

    public function getById(int $id)
    {
        return Booking::with([
            'user', 
            'items.travelPackage',
            'payment'
        ])
        ->findOrFail($id);
    }

    public function create(array $data)
    {
        return Booking::create($data);
    }

    public function updateBooking(int $id, array $data)
    {
        $booking = Booking::findOrFail($id);
        $booking->update($data);

        return $booking;
    }

    public function updateStatus(int $id, string $status)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => $status]);

        return $booking;
    }

    public function insertBookingItems(array $items)
    {
        return BookingItem::insert($items);
    }

    public function getTravelPackage(int $id)
    {
        return TravelPackage::findOrFail($id);
    }

    public function getExpiredBookings()
    {
        return Booking::where('status', 'pending')
            ->whereNotNull('expired_at')
            ->where('expired_at', '<', now())
            ->get();
    }

    public function bulkUpdateStatus(array $ids, string $status)
    {
        return Booking::whereIn('id', $ids)
            ->update(['status' => $status]);
    }
}