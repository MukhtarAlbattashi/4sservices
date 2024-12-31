<?php

namespace App\Http\Livewire\Customers;

use App\Models\Customer;
use Livewire\Component;

class CustomersSummary extends Component
{
    //get customers counts
    public $customersWithFullPaymentsCount = 0;
    public $customersWithRemainingPaymentsCount = 0;
    public $status = 'full';
    protected $paginationTheme = 'bootstrap';

    public function mount(): void
    {
        $this->customersWithFullPaymentsCount = Customer::query()->whereHas('invoices', function ($query) {
            $query->where('is_paid', true);
        })->count();
        $this->customersWithRemainingPaymentsCount = Customer::query()->whereHas('invoices', function ($query) {
            $query->where('is_paid', false);
        })->count();
    }


    public function render()
    {
        $customers = $this->status === 'full' ? $this->showCustomersWithFullPayments() : $this->showCustomersWithRemainingPayments();
        return view('livewire.customers.customers-summary', ['customers' => $customers]);
    }

    public function showCustomersWithRemainingPayments()
    {
        $this->status = 'remaining';
        return Customer::query()->whereHas('invoices', function ($query) {
            $query->where('is_paid', false);
        })->withCount('cars')
            ->withCount('invoices')
            ->withSum('invoices', 'total')
            ->withSum('payments', 'amount')
            ->withRemainingPayments()
            ->latest()
            ->paginate(15);
    }

    public function showCustomersWithFullPayments()
    {
        $this->status = 'full';
         return Customer::query()
             ->whereHas('invoices', function ($query) {
                 $query->where('is_paid', true);
             })
             ->whereHas('invoices', function ($query) {
                 $query->where('is_paid', false);
             })->withCount('cars')
             ->withCount('invoices')
             ->withSum('invoices', 'total')
             ->withSum('payments', 'amount')
             ->withRemainingPayments()
             ->latest()
             ->paginate(15);
    }

}
