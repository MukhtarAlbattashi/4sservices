<?php

namespace App\Http\Livewire\Customers;

use App\Models\Customer;
use Livewire\Component;

class CreateCustomer extends Component
{
    public Customer $customer;

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'customer.name' => ['required', 'string', 'max:255'],
        'customer.phone' => ['required', 'string', 'max:255', 'unique:customers,phone'],
        'customer.tax_no' => ['nullable', 'string', 'max:255', 'unique:customers,tax_no'],
        'customer.email' => ['nullable', 'string', 'email', 'max:255', 'unique:customers,email'],
        'customer.identity' => ['nullable', 'string', 'max:255', 'unique:customers,identity'],
        'customer.address' => ['nullable', 'string', 'max:255'],
        'customer.nationality' => ['nullable', 'string', 'max:255'],
        'customer.note' => ['nullable', 'string'],
    ];

    public function mount(): void
    {
        $this->customer = new Customer();
    }

    public function render()
    {
        return view('livewire.customers.create-customer');
    }

    public function save(): void
    {
        $this->validate();
        $this->customer->save();
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-create-model');
        $this->customer = new Customer();
        $this->emitUp('refreshParent');
    }
}
