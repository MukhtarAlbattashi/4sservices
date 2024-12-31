<?php

namespace App\Http\Livewire\Invoices;

use App\Models\InvoicePayments;
use App\Models\PurchasePayment;
use App\Traits\HasSettings;
use Livewire\Component;

class InvoicesPaymentPrintPage extends Component
{
    use HasSettings;
    public $invoicePayments;
    public function mount($id)
    {
        $this->invoicePayments = InvoicePayments::query()
        ->with('invoice', 'payment')
        ->find($id);
    }
    public function render()
    {
        $settings = $this->getSettings();
        return view('livewire.invoices.invoices-payment-print-page',[
            'settings' => $settings,
        ])
            ->extends('layouts.app')
            ->section('content');
    }
}
