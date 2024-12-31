<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'owner' => 'required|string|max:255',
            'owner_id' => 'nullable|numeric|max_digits:15',
            'number' => 'required|numeric|max:9999999|min:0',
            'letter' => 'required|string|min:0',
            'color' => 'required|string|max:255',
            'year' => 'required|numeric|digits:4|min:1990|max:3000',
            'chassis' => 'required|string|max:255',
            'cylinders' => 'required|numeric|min:0|max:20|max_digits:2',
            'notes' => 'nullable|string|max:255',
            'attach' => 'nullable|string',
            'other' => 'nullable|string',
            'customer_id' => 'required|exists:customers,id',
            'car_brand_id' => 'required|exists:car_brands,id',
            'car_model_id' => 'required|exists:car_models,id',
            'registration_type_id' => 'required|exists:registration_types,id',
            'user_id' => 'nullable|exists:users,id',
        ];
    }
}
