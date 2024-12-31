<?php

namespace App\Http\Livewire\Purchases;

use App\Models\Payment;
use App\Models\Purchase;
use App\Models\PurchasePayment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PurchasesAddPayment extends Component
{
    public $purchasePayment;

    public $search;

    public $purchaseId;

    public $payment;

    public $check;

    public $date;

    public $amount;

    public $restAmount;

    public $about;

    public $paid;

    public $remin;

    public $purchasePaymentId;

    protected $payments;

    protected $rules = [
        'payment' => 'required',
        'amount' => 'required|numeric|min:0.001',
    ];

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount($id)
    {
        $this->getPurchase($id);
    }

    public function getPurchase($id)
    {
        $this->purchasePaymentId = $id;
        $this->purchasePayment = Purchase::query()
            ->with('supplier:id,name,phone', 'payments.payment', 'payments.user')
            ->withSum('payments', 'remine')
            ->withSum('payments', 'amount')->find($id);
        $this->paid = $this->purchasePayment->payments_sum_amount ?? 0;
        $this->remin = $this->purchasePayment->payments_sum_remine ?? $this->purchasePayment->total;
        $this->about = trans('public.about').' '.trans('public.theInvoice').' '.$this->purchasePayment->id;
        if ($this->paid == 0) {
            $this->amount = $this->purchasePayment->total;
            $this->restAmount = 0;
        } else {
            $this->amount = number_format(($this->purchasePayment->total - $this->paid), 3);
            $this->restAmount = 0;
            $this->remin = $this->amount;
        }
    }

    public function render()
    {
        $this->date = date('Y-m-d', strtotime(now()));

        return view('livewire.purchases.purchases-add-payment');
    }

    public function getPayments()
    {
        if ($this->payments == null) {
            if (app()->getLocale() == 'ar') {
                $this->payments = Payment::orderBy('arName', 'asc')->pluck('arName', 'id');
            } else {
                $this->payments = Payment::orderBy('enName', 'asc')->pluck('enName', 'id');
            }
        }

        return $this->payments;
    }

    public function save()
    {
        $this->validate();
        if ($this->amount > 0) {
            $payment = new PurchasePayment();
            $payment->amount = $this->amount;
            $payment->remine = $this->restAmount;
            $payment->date = $this->date;
            $payment->check = $this->check;
            $payment->about = $this->about;
            $payment->payment_id = $this->payment;
            $payment->purchase_id = $this->purchasePayment->id;
            $payment->user_id = Auth::id();
            $payment->save();
            $this->notify('success', trans('public.success'));
            $this->emit('refreshComponent');
            $this->getPurchase($this->purchasePaymentId);
        } else {
            $this->notify('danger', trans('public.success'));
        }
    }

    public function updatedAmount()
    {
        if ($this->amount >= 0) {
            $this->restAmount = number_format(($this->remin - $this->amount), 3);
        } else {
            $this->amount = $this->remin;
            $this->restAmount = 0;
        }
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
        $this->emit('refreshComponent');
        $this->getPurchase($this->purchasePaymentId);
    }

    private function random_strings($length_of_string)
    {
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

        return substr(
            str_shuffle($str_result),
            0,
            $length_of_string
        );
    }
}
