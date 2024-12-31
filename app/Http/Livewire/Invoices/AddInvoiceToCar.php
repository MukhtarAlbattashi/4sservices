<?php

namespace App\Http\Livewire\Invoices;

use App\Models\Car;
use Livewire\Component;
use Livewire\WithPagination;
use Request;

class AddInvoiceToCar extends Component
{
    use WithPagination;

    public $search;

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->search = Request::query('search', '');
    }

    public function render()
    {
        return view('livewire.invoices.add-invoice-to-car', [
            'cars' => Car::query()->with(
                'customer:id,name,phone',
                'model:id,arName,enName',
                'brand:id,arName,enName',
                'type:id,arName,enName',
                'user:id,name'
            )
                ->withCount('invoices')
                ->withCount('jobs')
                ->withSum('invoices', 'total')
                ->withSum('payments', 'amount')
                ->mySearch($this->search)
                ->latest()
                ->paginate(10),
        ]);
    }
}
