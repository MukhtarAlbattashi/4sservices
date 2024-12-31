<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255', 'unique:customers,phone'],
            'tax_no' => ['nullable', 'string', 'max:255', 'unique:customers,tax_no'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:customers,email'],
            'identity' => ['nullable', 'string', 'max:255', 'unique:customers,identity'],
            'address' => ['nullable', 'string', 'max:255'],
            'nationality' => ['nullable', 'string', 'max:255'],
            'note' => ['nullable', 'string'],
        ];
    }
}
