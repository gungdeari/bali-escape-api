<?php

namespace App\Services;

use App\Repositories\BookingRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class BookingService
{
    public function __construct(protected BookingRepository $bookingRepository
    ) {
        $this->bookingRepository = $bookingRepository;
    }

    public function create(array $data, $user)
    {
        return DB::transaction(function () use ($data, $user) {

            // Generate booking code
            $bookingCode = 'TRX-' . strtoupper(Str::random(8));

            // Create booking
            $booking = $this->bookingRepository->create([
                'user_id' => $user->id,
                'booking_code' => $bookingCode,
                'total_price' => 0,
                'status' => 'pending',
                'expired_at' => now()->addHours(2),
            ]);

            $itemsData = [];
            $totalPrice = 0;

            foreach ($data['items'] as $item) {
                $travelPackage = $this->bookingRepository
                    ->getTravelPackage($item['travel_package_id']);
                if (!$travelPackage->is_active) {
                    throw new \Exception('Package not available');
                }

                $price = $travelPackage->price;
                $quantity = $item['quantity'];
                $subtotal = $price * $quantity;

                $totalPrice += $subtotal;

                $itemsData[] = [
                    'booking_id' => $booking->id,
                    'travel_package_id' => $travelPackage->id,
                    'quantity' => $quantity,
                    'price' => $price,
                    'subtotal' => $subtotal,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            $this->bookingRepository->insertBookingItems($itemsData);

            $booking = $this->bookingRepository->updateBooking(
                $booking->id,
                ['total_price' => $totalPrice]
            );

            return $this->bookingRepository
                ->getById($booking->id);
        });
    }

    public function getBookings($user)
    {
        return $user->hasRole('admin')
            ? $this->bookingRepository->getAll()
            : $this->bookingRepository->getByUser($user->id);
    }

    public function updateStatus(int $id, string $status)
    {
        $booking = $this->bookingRepository->getById($id);

        if ($booking->status === 'cancelled') {
            throw new \Exception('Cannot update cancelled booking');
        }
        if ($booking->status === 'completed') {
            throw new \Exception('Already completed');
        }

        //update bookin status
        $updated = $this->bookingRepository->updateBooking($id, [
            'status' => $status
        ]);

        if($status === 'confirmed' && $booking->payment) {
            $booking->payment->update([
                'status' => 'paid',
                'paid_at' => now(),
            ]);
        }

        return $updated;
    }

    public function getById(int $id)
    {
        return $this->bookingRepository->getById($id);
    }

    public function autoCancelExpired()
    {
        $expiredBookings = $this->bookingRepository->getExpiredBookings();

        if ($expiredBookings->isEmpty()) {
            return 0;
        }

        $ids = $expiredBookings->pluck('id')->toArray();

        $this->bookingRepository->bulkUpdateStatus($ids, 'cancelled');

        return count($ids);
    }
}