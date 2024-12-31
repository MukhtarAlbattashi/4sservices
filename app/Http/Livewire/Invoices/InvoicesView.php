<?php

namespace App\Http\Livewire\Invoices;

use App\Models\Invoice;
use App\Models\Purchase;
use App\Traits\HasSettings;
use Livewire\Component;

class InvoicesView extends Component
{
    use HasSettings;
    public $invoiceView;

    public function mount($id)
    {
        $this->invoiceView = Invoice::query()->with('car','services', 'parts')->find($id);
    }

    public function render()
    {
        $settings = $this->getSettings();
        return view('livewire.invoices.invoices-view',[
            'settings' => $settings,
        ])
            ->extends('layouts.app')
            ->section('content');
    }
}
