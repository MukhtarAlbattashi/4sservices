<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JopStatusRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'arName' => 'required|string|max:255',
            'enName' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'user_id' => 'nullable|exists:users,id',
        ];
    }
}
