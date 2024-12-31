<?php

namespace App\Http\Livewire\Purchases;

use App\Models\Purchase;
use Livewire\Component;
use Livewire\WithPagination;

class PurchasesPage extends Component
{
    use WithPagination;

    public $search;

    public $purchaseId;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $query = Purchase::query()
            ->with('user:id,name', 'supplier:id,name,phone')
            ->withSum('payments', 'amount')
            ->mySearch($this->search)
            ->latest();

        if (\Auth::user()->hasRole('super-admin')) {
            $query->withTrashed();
        }

        $items = $query->paginate(10);

        return view('livewire.purchases.purchases-page', [
            'purchases' => $items,
        ]);
    }

    public function remove($id)
    {
        $this->purchaseId = $id;
        $this->dispatchBrowserEvent('show-delete-model');
    }

    public function delete()
    {
        Purchase::query()->findOrFail($this->purchaseId)->delete();
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-delete-model');
        $this->purchaseId = null;
        $this->reset();
    }

    public function restore($id)
    {
        Purchase::query()->withTrashed()->findOrFail($id)->restore();
        $this->notify('success', trans('public.success'));
    }

    public function forceDelete($id)
    {
        Purchase::query()->where('id', $id)->forceDelete();
        $this->notify('success', trans('public.success'));
    }
}
