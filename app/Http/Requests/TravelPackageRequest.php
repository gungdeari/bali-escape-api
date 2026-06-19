<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TravelPackageRequest extends FormRequest
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
        $id = $this->route('travel-package');
        
        return [
            'destination_id' => 'required|exists:destinations,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'max_people' => 'nullable|integer|min:1',
            'difficulty_level' => 'nullable|string',
            'is_active' => 'boolean',

            // images
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
            'primary_index' => 'nullable|integer|min:0'
        ];
    }
}
