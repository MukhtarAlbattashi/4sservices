<?php

namespace App\Http\Livewire\Quotations;

use App\Models\Invoice;
use App\Models\Purchase;
use App\Models\Quotation;
use App\Traits\HasSettings;
use Livewire\Component;

class QuotationsPrint extends Component
{
    use HasSettings;
    public $quotationView;

    public function mount($id)
    {
        $this->quotationView = Quotation::query()->with('car', 'services', 'parts')->find($id);
    }

    public function render()
    {
        $settings = $this->getSettings();
        return view('livewire.quotations.quotations-print',[
            'settings' => $settings,
        ])->extends('layouts.app')
            ->section('content');
    }
}
