<?php

namespace App\Http\Livewire\Purchases;

use App\Models\Purchase;
use Livewire\Component;

class PurchasesView extends Component
{
    public $purchaseView;

    public function mount($id)
    {
        $this->purchaseView = Purchase::query()->with('supplier:id,name,phone', 'parts')->find($id);
    }

    public function render()
    {
        return view('livewire.purchases.purchases-view');
    }
}
