<?php

namespace App\Http\Livewire\Invoices;

use App\Models\Invoice;
use App\Models\Purchase;
use App\Traits\HasSettings;
use Livewire\Component;

class InvoicesViewUuid extends Component
{
    use HasSettings;
    public $invoiceView;

    public function mount($uuid)
    {
        $this->invoiceView = Invoice::query()
            ->with('car', 'services', 'parts')
            ->where('uuid', $uuid)
            ->firstOrFail();
    }

    public function render()
    {
        $settings = $this->getSettings();
        return view('livewire.invoices.invoices-view-uuid',[
            'settings' => $settings,
        ])
            ->extends('layouts.app')
            ->section('content');
    }
}
