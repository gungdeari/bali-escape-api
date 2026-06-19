<?php

namespace App\Services;

use App\Repositories\PaymentRepository;
use Illuminate\Support\Str;
use Exception;

class PaymentService
{
    protected PaymentRepository $paymentRepository;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function store(array $data, $user)
    {
        $booking = $this->paymentRepository->findBooking($data['booking_id']);

        if ($booking->user_id !== $user->id) {
            throw new Exception('Unauthorized');
        }

        if ($booking->status !== 'pending') {
            throw new Exception('Booking already processed');
        }

        if ($booking->expired_at && now()->greaterThan($booking->expired_at)) {
            throw new Exception('Booking expired');
        }

        // handle proof of payment image upload
        // Storage::disk('public') saves to storage/app/public/
        // after running php artisan storage:link, accessible at /storage/
        $proofPath = null;
        if (isset($data['proof_of_payment'])) {
            $proofPath = $data['proof_of_payment']->store(
                'payment-proofs',  // folder inside storage/app/public/
                'public'           // disk
            );
        }

        $payment = $this->paymentRepository->create([
            'booking_id'            => $booking->id,
            'payment_method'        => $data['payment_method'],
            'amount'                => $booking->total_price,
            'status'                => 'waiting_confirmation',
            'transaction_reference' => 'PAY-' . strtoupper(Str::random(10)),
            'proof_of_payment'      => $proofPath,
            'paid_at'               => null,
        ]);

        $payment->load(['booking.items.travelPackage']);

        return $payment;
    }

    public function getPayments($user)
    {
        if ($user->hasRole('admin')) {
            return $this->paymentRepository->getAll();
        }

        return $this->paymentRepository->getByUser($user->id);
    }

    public function getPaymentDetail(int $id, $user)
    {
        $payment = $this->paymentRepository->findByIdWithRelations($id);

        if (
            $payment->booking->user_id !== $user->id &&
            !$user->hasRole('admin')
        ) {
            throw new \Exception('Unauthorized');
        }

        return $payment;
    }

    // called by admin to confirm payment and update booking status
    // this is what triggers the booking becoming 'confirmed'
    public function confirmPayment(int $paymentId)
    {
        $payment = $this->paymentRepository->findByIdWithRelations($paymentId);

        if ($payment->status !== 'waiting_confirmation') {
            throw new Exception('Payment is not waiting for confirmation');
        }

        // mark payment as paid with timestamp
        $payment->update([
            'status'  => 'paid',
            'paid_at' => now(),
        ]);

        // now confirm the booking
        $this->paymentRepository->updateBookingStatus(
            $payment->booking_id,
            'confirmed'
        );

        return $payment;
    }
}