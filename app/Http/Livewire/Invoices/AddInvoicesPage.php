<?php

namespace App\Http\Livewire\Invoices;

use App\Models\Car;
use App\Models\Invoice;
use App\Models\JobCard;
use App\Models\Part;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class AddInvoicesPage extends Component
{
    use WithFileUploads;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $searchPart;

    public $searchService;

    public $car;

    public $jobCard;

    public $subTotal = 0;

    public $total = 0;

    public $tax = 0;

    public $discount = 0;

    public $gtax = 0;

    public $partId;

    public $totalPricePart = 0;

    public $subTotalPart = 0;

    public $serviceId;

    public $totalPriceService = 0;

    public $subTotalService = 0;

    public $quantity = [];

    public $quantityService = [];

    public $date;

    public array $addedParts = [];

    public array $addedServices = [];
    public $notes;

    public function mount(Car $car)
    {
        $this->car = $car;
        $this->gtax = Setting::query()->first()->value('tax');
        $this->tax = $this->gtax;
    }

    protected $rules = [
        'jobCard' => 'required|numeric',
    ];

    public function render()
    {
        $this->date = date('Y-m-d', strtotime(now()));

        return view('livewire.invoices.add-invoices-page', [
            'parts' => Part::query()
                ->withSum('purchases', 'part_purchase.quantity')
                ->withSum('invoices', 'invoice_part.quantity')
                ->mySearch($this->searchPart)
                ->latest()
                ->paginate(10),
            'services' => Service::query()
                ->mySearch($this->searchService)
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

    public function addToInvoiceService($service)
    {
        if (! in_array($service, $this->addedServices)) {
            $this->addedServices[] = $service;
            $this->quantityService[] = 1;
            $this->notify('success', trans('public.success'));
            $this->calcTotal();
        } else {
            $this->notify('danger', trans('public.itemAlreadyThere'));
        }
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

    public function removeService($service)
    {
        unset($this->addedServices[$service]);
        $this->addedServices = array_values($this->addedServices);
        unset($this->quantityService[$service]);
        $this->quantityService = array_values($this->quantityService);
        $this->notify('success', trans('public.success'));
        $this->calcTotal();
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

    public function calcTotalPriceService()
    {
        $this->subTotalService = 0;
        $i = 0;
        foreach ($this->addedServices as $service) {
            if (isset($this->quantityService) && ! empty($this->quantityService)) {
                $q = 0;
                if (array_key_exists($i, $this->quantityService)) {
                    $q = floatval($this->quantityService[$i]);
                }
                $this->subTotalService = floatval($this->subTotalService) + (floatval($service['amount'] * $q));
            } else {
                $this->subTotalService = floatval($this->subTotalService) + (floatval($service['amount']) * 0);
            }
            $i++;
        }
        $this->totalPriceService = floatval($this->subTotalService);
    }

    public function calcTotal()
    {
        $this->calcTotalPrice();
        $this->calcTotalPriceService();
        $this->subTotal = $this->totalPricePart + $this->totalPriceService;
        $beforeTax = floatval((($this->totalPricePart + $this->totalPriceService - floatval($this->discount)) * $this->tax) / 100);
        $this->total = ($beforeTax + floatval($this->totalPricePart + $this->totalPriceService)) - floatval($this->discount);
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

    public function UpdatedQuantityService($value, $key)
    {
        foreach ($this->quantityService as $index => $value) {
            if (floatval($this->quantityService[$index]) <= 0 || floatval($this->quantityService[$index]) == null || ! is_numeric(floatval($this->quantityService[$index]))) {
                $this->quantityService[$index] = 1;
            }
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
        $item = JobCard::query()->where('id', $this->jobCard)->first();
        if (! $item) {
            $this->notify('danger', trans('public.not-available'));

            return false;
        }
        $this->validate();
        $invoice = new Invoice();
        $invoice->uuid = Str::uuid();
        $invoice->services_total = $this->subTotalService;
        $invoice->parts_total = $this->subTotalPart;
        $invoice->job_card_id = $this->jobCard;
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
        foreach ($this->addedServices as $index => $service) {
            $invoice->services()->attach($service['id'], ['quantity' => $this->quantityService[$index]]);
        }
        $this->notify('success', trans('public.success'));
        to_route('invoices');
    }

    public function viewCardJob()
    {
        if (! empty($this->addedParts) || ! empty($this->addedServices)) {
            $this->saveInvoice();
        }
        $item = JobCard::query()->where('id', $this->jobCard)->first();
        if ($item) {
            to_route('edit-jop-card', [$this->car, $item->id]);
        } else {
            $this->notify('danger', trans('public.jobCardNotFound'));
        }
    }
}
