<?php

namespace App\Http\Livewire\Invoices;

use App\Models\Invoice;
use App\Models\InvoicePayments;
use App\Models\JobCard;
use App\Models\JopStatus;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class InvoicesAddPayment extends Component
{
    public $invoicePayment;

    public $search;

    public $InvoiceId;

    public $payment;

    public $check;

    public $date;

    public $amount;

    public $restAmount;

    public $about;

    public $paid;

    public $remin;

    public $invoicePaymentId;

    public $carInfo;

    public $jobCardId;

    protected $payments;

    protected $rules = [
        'payment' => 'required',
        'amount' => 'required|numeric|min:0.001',
    ];

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount($id)
    {
        $this->getInvoices($id);
        $this->carInfo = Invoice::query()->whereId($id)->first()->car;
        $this->jobCardId = Invoice::query()->whereId($id)->first()->job_card_id;
    }

    public function getInvoices($id)
    {
        $this->invoicePaymentId = $id;
        $this->invoicePayment = Invoice::query()
            ->with('car', 'payments.payment', 'payments.user')
            ->withSum('payments', 'remine')
            ->withSum('payments', 'amount')->find($id);
        $this->paid = $this->invoicePayment->payments_sum_amount ?? 0;
        $this->remin = $this->invoicePayment->payments_sum_remine ?? $this->invoicePayment->total;
        $this->about = trans('public.about').' '.trans('public.theInvoice').' '.$this->invoicePayment->id;
        if ($this->paid == 0) {
            $this->amount = $this->invoicePayment->total;
            $this->restAmount = 0;
        } else {
            $this->amount = number_format(($this->invoicePayment->total - $this->paid), 3);
            $this->restAmount = 0;
            $this->remin = $this->amount;
        }
        if ($this->remin == 0) {
            $jobId = Invoice::query()->where('id', $id)->first()->job_card_id;
            if (isset($jobId)) {
                $job = JobCard::query()->where('id', $jobId)->first();
                $state = JopStatus::query()->where('enName', 'Done')->first();
                $job->jop_status_id = $state->id;
                $job->save();
            }
        }
    }

    public function save()
    {
        $this->validate();
        if ($this->amount > 0) {
            $payment = new InvoicePayments();
            $payment->amount = $this->amount;
            $payment->remine = $this->restAmount;
            $payment->date = $this->date;
            $payment->check = $this->check;
            $payment->about = $this->about;
            $payment->payment_id = $this->payment;
            $payment->invoice_id = $this->invoicePayment->id;
            $payment->user_id = Auth::id();
            $payment->save();
            $this->notify('success', trans('public.success'));
            $this->makePaymentComplete();
            $this->emit('refreshComponent');
            $this->getInvoices($this->invoicePaymentId);
        } else {
            $this->notify('danger', trans('public.error'));
        }

    }

    public function render()
    {
        $this->date = date('Y-m-d', strtotime(now()));

        return view('livewire.invoices.invoices-add-payment');
    }

    private function makePaymentComplete(){
        $payments = InvoicePayments::query()->where('invoice_id', $this->invoicePaymentId)->sum('amount');
        $invoice = Invoice::query()->where('id', $this->invoicePaymentId)->first();
        if ($payments >= $invoice->total) {
            $invoice->is_paid = true;
        }else{
            $invoice->is_paid = false;
        }
        $invoice->save();
    }

    public function getPayments()
    {
        if ($this->payments == null) {
            $this->payments = Payment::orderBy(app()->getLocale() == 'ar' ? 'arName' : 'enName')->pluck(app()->getLocale() == 'ar' ? 'arName' : 'enName', 'id');
        }

        return $this->payments;
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
        $this->InvoiceId = $id;
        $this->dispatchBrowserEvent('show-delete-model');
    }

    public function delete()
    {
        InvoicePayments::query()->findOrFail($this->InvoiceId)->delete();
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-delete-model');
        $this->emit('refreshComponent');
        $this->getInvoices($this->invoicePaymentId);
        $this->makePaymentComplete();
    }
}
