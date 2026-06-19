<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                    => $this->id,
            'booking_id'            => $this->booking_id,
            'payment_method'        => $this->payment_method,
            'amount'                => $this->amount,
            'status'                => $this->status,
            'transaction_reference' => $this->transaction_reference,
            // generate full URL for the proof image
            // asset() prepends your app URL so frontend gets a complete URL
            'proof_of_payment'      => $this->proof_of_payment
                ? asset('storage/' . $this->proof_of_payment)
                : null,
            'paid_at'               => $this->paid_at,
            'created_at'            => $this->created_at,
            'booking' => new BookingResource(
                $this->whenLoaded('booking')
            ),
        ];
    }
}
