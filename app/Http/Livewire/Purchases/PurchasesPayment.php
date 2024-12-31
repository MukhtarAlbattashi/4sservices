<?php

namespace App\Http\Livewire\Purchases;

use App\Models\PurchasePayment;
use Livewire\Component;
use Livewire\WithPagination;

class PurchasesPayment extends Component
{
    use WithPagination;

    public $search;

    public $purchaseId;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.purchases.purchases-payment', [
            'purchases' => PurchasePayment::query()->with('user', 'purchase', 'purchase.supplier')
                ->mySearch($this->search)
                ->latest()
                ->paginate(10),
        ]);
    }

    public function remove($id)
    {
        $this->purchaseId = $id;
        $this->dispatchBrowserEvent('show-delete-model');
    }

    public function delete()
    {
        PurchasePayment::query()->findOrFail($this->purchaseId)->delete();
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-delete-model');
        $this->purchaseId = null;
        $this->reset();
    }
}
