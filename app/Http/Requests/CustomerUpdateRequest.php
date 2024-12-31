<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property mixed $customer
 */
class CustomerUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255', Rule::unique('customers')->ignore($this->customer)],
            'tax_no' => ['nullable', 'string', 'max:255', Rule::unique('customers')->ignore($this->customer)],
            'email' => ['nullable', 'string', 'email', 'max:255', Rule::unique('customers')->ignore($this->customer)],
            'identity' => ['nullable', 'string', 'max:255', Rule::unique('customers')->ignore($this->customer)],
            'address' => ['nullable', 'string', 'max:255'],
            'nationality' => ['nullable', 'string', 'max:255'],
            'note' => ['nullable', 'string'],
        ];
    }
}
