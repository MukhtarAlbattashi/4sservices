<?php

namespace App\Http\Livewire\Invoices;

use App\Models\InvoicePayments;
use Livewire\Component;
use Livewire\WithPagination;

class InvoicesPayment extends Component
{
    use WithPagination;

    public $search;

    public $InvoiceId;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.invoices.invoices-payment', [
            'invoices' => InvoicePayments::query()->with(
                'user',
                'invoice.customer'
            )->mySearch($this->search)->latest()->paginate(10),
        ]);
    }

    public function remove($id)
    {
        $this->InvoiceId = $id;
        $this->dispatchBrowserEvent('show-delete-model');
    }

    public function delete()
    {
        InvoicePayments::query()->findOrFail($this->InvoiceId)->delete();
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-delete-model');
    }
}
