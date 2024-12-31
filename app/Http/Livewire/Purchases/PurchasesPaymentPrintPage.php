<?php

namespace App\Http\Livewire\Purchases;

use App\Models\PurchasePayment;
use App\Traits\HasSettings;
use Livewire\Component;

class PurchasesPaymentPrintPage extends Component
{
    use HasSettings;

    public $purchasePayment;

    public function mount($id)
    {
        $this->purchasePayment = PurchasePayment::query()
        ->with('purchase', 'payment')
        ->find($id);
    }
    public function render()
    {
        $settings = $this->getSettings();
        return view('livewire.purchases.purchases-payment-print-page', [
            'settings' => $settings,
        ])
            ->extends('layouts.app')
            ->section('content');
    }
}
