<?php

namespace App\Http\Livewire\Quotations;

use App\Models\Invoice;
use App\Models\Purchase;
use App\Models\Quotation;
use Livewire\Component;

class QuotationsView extends Component
{
    public $quotationView;

    public function mount($id)
    {
        $this->quotationView = Quotation::query()->with('car','services', 'parts')->find($id);
    }

    public function render()
    {
        return view('livewire.quotations.quotations-view');
    }
}
