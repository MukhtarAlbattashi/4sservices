<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarModelFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'arName' => 'required|string|max:250',
            'enName' => 'required|string|max:250',
            'car_brand_id' => 'required|exists:car_brands,id',
            'user_id' => 'nullable|exists:users,id',
            'image' => 'nullable|image',
        ];
    }
}
