<?php

namespace App\Http\Livewire\Customers;

use App\Models\Customer;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Customers extends Component
{
    use WithPagination;

    public $search;
    public $customersWithFullPaymentsCount = 0;
    public $customersWithRemainingPaymentsCount = 0;
    public Customer $editCustomer;

    public $customerId;

    protected $paginationTheme = 'bootstrap';

    protected function rules()
    {
        return [
            'editCustomer.name' => ['required', 'string', 'max:255'],
            'editCustomer.phone' => [
                'required', 'string', 'max:255', Rule::unique('customers', 'phone')->ignore($this->customerId)
            ],
            'editCustomer.tax_no' => ['nullable', 'string', 'max:255', Rule::unique('customers', 'tax_no')->ignore($this->customerId)],
            'editCustomer.email' => ['nullable', 'string', 'email', 'max:255', Rule::unique('customers', 'email')->ignore($this->customerId)],
            'editCustomer.identity' => ['nullable', 'string', 'max:255', Rule::unique('customers', 'identity')->ignore($this->customerId)],
            'editCustomer.address' => ['nullable', 'string', 'max:255'],
            'editCustomer.note' => ['nullable', 'string'],
        ];
    }

    protected $listeners = [
        'refreshParent' => '$refresh',
    ];

    public function mount(): void
    {
        $this->search = \Request::query('search', '');
        $this->resetInputFields();
        $this->customersWithFullPaymentsCount = Customer::query()->whereHas('invoices', function ($query) {
            $query->where('is_paid', true);
        })->count();
        $this->customersWithRemainingPaymentsCount = Customer::query()->whereHas('invoices', function ($query) {
            $query->where('is_paid', false);
        })->count();
    }

    public function render()
    {
        return view('livewire.customers.customers', [
            'customers' => Customer::query()
                ->withCount('cars')
                ->withCount('invoices')
                ->withSum('invoices', 'total')
                ->withSum('payments', 'amount')
                ->withRemainingPayments()
                ->mySearch($this->search)
                ->latest()
                ->paginate(15)
        ]);
    }

    public function update($id): void
    {
        $this->customerId = $id;
        $this->editCustomer = Customer::query()->findOrFail($this->customerId);
        $this->dispatchBrowserEvent('show-edit-model');
    }

    public function updateCustomer(): void
    {
        $this->validate();
        $this->editCustomer->save();
        $this->notify('info', trans('public.update'));
        $this->dispatchBrowserEvent('hide-edit-model');
        $this->resetInputFields();
    }

    public function resetInputFields(): void
    {
        $this->editCustomer = new Customer;
    }

    public function delete(): void
    {
        Customer::query()->findOrFail($this->customerId)->delete();
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-delete-model');
        $this->customerId = null;
        $this->redirect('/customers');
    }

    public function createNewCarForCustomer($customerId)
    {
        return to_route('customerCar', ['customerId' => $customerId]);
    }
}
