<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'booking_id' => [
                'required',
                'exists:bookings,id'
            ],
            'payment_method' => [
                'required',
                'in:bank_transfer,ewallet'
            ],
            'proof_of_payment' => [
                'required_if:payment_method,bank_transfer',
                'nullable',
                'image',
                'mimes:jpeg,png,jpg',
                'max:2048',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'proof_of_payment.required_if' => 'Transfer proof is required for bank transfer payments.',
            'proof_of_payment.image'        => 'Proof must be an image file.',
            'proof_of_payment.max'          => 'Image must be smaller than 2MB.',
        ];
    }
}
