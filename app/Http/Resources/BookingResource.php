<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'booking_code' => $this->booking_code,
            'total_price' => $this->total_price,
            'status' => $this->status,
            'expired_at' => $this->expired_at,

            'user' => new UserResource(
                $this->whenLoaded('user')
            ),

            'items' => BookingItemResource::collection(
                $this->whenLoaded('items')
            ),

            'payment' => $this->whenLoaded('payment', function () {
                return [
                    'id'             => $this->payment->id,
                    'payment_method' => $this->payment->payment_method,
                    'amount'         => $this->payment->amount,
                    'status'         => $this->payment->status,
                    'proof_of_payment' => $this->payment->proof_of_payment
                        ? asset('storage/' . $this->payment->proof_of_payment)
                        : null,
                    'paid_at'        => $this->payment->paid_at,
                    'created_at'     => $this->payment->created_at,
                ];
            }),

            'created_at' => $this->created_at,
        ];
    }
}
