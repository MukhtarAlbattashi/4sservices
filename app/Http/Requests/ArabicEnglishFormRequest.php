<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArabicEnglishFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'arName' => 'required|string|max:255',
            'enName' => 'required|string|max:255',
            'user_id' => 'nullable|exists:users,id',
        ];
    }
}
