<?php

namespace App\Http\Livewire\Invoices;

use App\Models\Car;
use App\Models\Invoice;
use App\Models\Part;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class AddInvoiceParts extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $searchPart;

    public $car;

    public $subTotal = 0;

    public $total = 0;

    public $tax = 0;

    public $discount = 0;

    public $gtax = 0;

    public $partId;

    public $totalPricePart = 0;

    public $subTotalPart = 0;

    public $quantity = [];

    public $date;

    public array $addedParts = [];

    public $notes;

    protected $paginationTheme = 'bootstrap';

    public function mount(Car $car)
    {
        $this->car = $car;
        $this->gtax = Setting::query()->first()->value('tax');
        $this->tax = $this->gtax;
    }

    public function render()
    {
        $this->date = date('Y-m-d', strtotime(now()));

        return view('livewire.invoices.add-invoice-parts', [
            'parts' => Part::query()
                ->withSum('purchases', 'part_purchase.quantity')
                ->withSum('invoices', 'invoice_part.quantity')
                ->mySearch($this->searchPart)
                ->latest()
                ->paginate(10),
        ]);
    }

    public function addToInvoice($part)
    {
        if (! in_array($part, $this->addedParts)) {
            $this->addedParts[] = $part;
            $this->quantity[] = 1;
            $this->notify('success', trans('public.success'));
            $this->calcTotal();
        } else {
            $this->notify('danger', trans('public.itemAlreadyThere'));
        }
    }

    public function calcTotal()
    {
        $this->calcTotalPrice();
        $this->subTotal = $this->totalPricePart;
        $beforeTax = floatval((($this->totalPricePart) * $this->tax) / 100);
        $this->total = ($beforeTax + floatval($this->totalPricePart)) - floatval($this->discount);
    }

    public function calcTotalPrice()
    {
        $this->subTotalPart = 0;
        $i = 0;
        foreach ($this->addedParts as $part) {
            if (isset($this->quantity) && ! empty($this->quantity)) {
                $q = 0;
                if (array_key_exists($i, $this->quantity)) {
                    $q = floatval($this->quantity[$i]);
                }
                $this->subTotalPart = floatval($this->subTotalPart) + (floatval($part['sale_price'] * $q));
            } else {
                $this->subTotalPart = floatval($this->subTotalPart) + (floatval($part['sale_price']) * 0);
            }
            $i++;
        }
        $this->totalPricePart = floatval($this->subTotalPart);
    }

    public function remove($part)
    {
        unset($this->addedParts[$part]);
        $this->addedParts = array_values($this->addedParts);
        unset($this->quantity[$part]);
        $this->quantity = array_values($this->quantity);
        $this->notify('success', trans('public.success'));
        $this->calcTotal();
    }

    public function updatedTax()
    {
        if ($this->tax == null || floatval($this->tax) < 0 || ! is_numeric(floatval($this->tax))) {
            $this->tax = 0;
        }
        $this->calcTotal();
    }

    public function updatedDiscount()
    {
        if (floatval($this->discount) == null || floatval($this->discount) < 0 || ! is_numeric(floatval($this->discount))) {
            $this->discount = 0;
        }
        $this->calcTotal();
    }

    public function UpdatedQuantity($value, $key)
    {
        $item = $this->addedParts[$key];
        if (($item['purchases_sum_part_purchasequantity'] - $item['invoices_sum_invoice_partquantity']) >= $value) {
            foreach ($this->quantity as $index => $value) {
                if (floatval($this->quantity[$index]) <= 0 || floatval($this->quantity[$index]) == null || ! is_numeric(floatval($this->quantity[$index]))) {
                    $this->quantity[$index] = 1;
                }
            }
            $this->calcTotal();
        } else {
            $this->quantity[$key] = $item['purchases_sum_part_purchasequantity'] - $item['invoices_sum_invoice_partquantity'];
            $this->notify('danger', trans('public.quantityMoreThanStore'));
        }
    }

    public function saveInvoice()
    {
        $invoice = new Invoice();
        $invoice->uuid = Str::uuid();
        $invoice->services_total = 0;
        $invoice->parts_total = $this->subTotalPart;
        $invoice->job_card_id = null;
        $invoice->tax = $this->tax;
        $invoice->discount = $this->discount;
        $invoice->total = $this->total;
        $invoice->date = $this->date;
        $invoice->car_id = $this->car->id;
        $invoice->customer_id = $this->car->customer->id;
        $invoice->user_id = Auth::id();
        $invoice->notes = $this->notes;
        $invoice->save();
        foreach ($this->addedParts as $index => $part) {
            $invoice->parts()->attach($part['id'], ['quantity' => $this->quantity[$index]]);
        }
        $this->notify('success', trans('public.success'));
        to_route('invoices');
    }
}
