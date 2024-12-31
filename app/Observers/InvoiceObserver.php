<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use App\Models\Invoice;

class InvoiceObserver
{
    public function created(Invoice $invoice): void
    {

    }

    public function updated(Invoice $invoice): void
    {
    }

    public function deleted(Invoice $invoice): void
    {
        $invoice->user_id = Auth::id();
        $invoice->save();
    }

    public function restored(Invoice $invoice): void
    {
    }

    public function forceDeleted(Invoice $invoice): void
    {
    }
}
