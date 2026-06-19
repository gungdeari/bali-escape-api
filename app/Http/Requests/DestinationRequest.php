<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DestinationRequest extends FormRequest
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
        $id = $this->route('destination')?->id;

        return [
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string',
            'description' => 'nullable|string',
            'is_active' => 'required|boolean',

            'slug' => [
                'nullable',
                Rule::unique('destinations', 'slug')->ignore($id),
            ],
        ];
    }
}
