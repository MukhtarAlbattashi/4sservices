<?php

namespace App\Http\Livewire\Purchases;

use App\Models\Part;
use App\Models\Purchase;
use App\Models\Setting;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class AddPurchasesPage extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $search;

    public $partId;

    public $purchase_price;

    public $totalPrice = 0;

    public $gtax = 5;

    public $discount = 0;

    public $subTotal = 0;

    public $tax = 0;

    public $supplier;

    public $quantity = [];

    public $date;

    public array $addedParts = [];

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'refreshParent' => '$refresh',
    ];

    protected $suppliers;

    protected $rules = [
        'purchase_price' => 'required|numeric|min:0',
    ];

    public function mount()
    {
        $this->gtax = Setting::query()->first()->value('tax');
        $this->tax = $this->gtax;
    }

    public function render()
    {
        $this->date = date('Y-m-d', strtotime(now()));

        return view('livewire.purchases.add-purchases-page', [
            'parts' => Part::query()
                ->withSum('purchases', 'part_purchase.quantity')
                ->withSum('invoices', 'invoice_part.quantity')
                ->mySearch($this->search)
                ->latest()
                ->paginate(10),
        ]);
    }

    public function addToInvoice($part)
    {
        if (!in_array($part, $this->addedParts)) {
            $this->addedParts[] = $part;
            $this->quantity[] = 1;
            $this->notify('success', trans('public.success'));
            $this->calcTotalPrice();
        } else {
            $this->notify('danger', trans('public.itemAlreadyThere'));
        }
    }

    public function calcTotalPrice()
    {
        $this->subTotal = 0;
        $i = 0;
        foreach ($this->addedParts as $part) {
            if (isset($this->quantity) && !empty($this->quantity)) {
                $q = 0;
                if (array_key_exists($i, $this->quantity)) {
                    $q = floatval($this->quantity[$i]);
                }
                $this->subTotal = floatval($this->subTotal) + floatval($part['purchase_price'] * $q);
            } else {
                $this->subTotal = floatval($this->subTotal) + floatval($part['purchase_price']) * 0;
            }
            $i++;
        }
        $beforetax = floatval($this->subTotal * $this->tax / 100);
        $this->totalPrice = $beforetax + floatval($this->subTotal) - floatval($this->discount);
    }

    public function remove($part)
    {
        unset($this->addedParts[$part]);
        $this->addedParts = array_values($this->addedParts);
        unset($this->quantity[$part]);
        $this->quantity = array_values($this->quantity);
        $this->notify('success', trans('public.success'));
        $this->calcTotalPrice();
    }

    public function updatedTax()
    {
        if ($this->tax == null || floatval($this->tax) < 0 || !is_numeric(floatval($this->tax))) {
            $this->tax = 0;
        }
        $this->calcTotalPrice();
    }

    public function updatedDiscount()
    {
        if ($this->discount === null || floatval($this->discount) < 0 || !is_numeric(floatval($this->discount))) {
            $this->discount = 0;
        }
        $this->calcTotalPrice();
    }

    public function getSuppliers()
    {
        if ($this->suppliers == null) {
            $this->suppliers = Supplier::orderBy('name', 'asc')->select('id', 'name', 'phone')->get();
        }

        return $this->suppliers;
    }

    public function saveInvoice()
    {
        $this->validate(
            [
                'supplier' => 'required',
            ]
        );
        $purchase = new Purchase();
        $purchase->sub_total = $this->subTotal;
        $purchase->tax = $this->tax;
        $purchase->discount = $this->discount;
        $purchase->total = $this->totalPrice;
        $purchase->date = $this->date;
        $purchase->supplier_id = $this->supplier;
        $purchase->user_id = Auth::id();
        $purchase->save();
        foreach ($this->addedParts as $index => $part) {
            $purchase->parts()->attach($part['id'], ['quantity' => $this->quantity[$index]]);
        }
        $this->notify('success', trans('public.success'));
        $this->reset();
        to_route('purchases');
    }

    public function UpdatedQuantity()
    {
        foreach ($this->quantity as $index => $value) {
            if (floatval($this->quantity[$index]) <= 0 || floatval($this->quantity[$index]) == null || !is_numeric(floatval($this->quantity[$index]))) {
                $this->quantity[$index] = 1;
            }
        }
        $this->calcTotalPrice();
    }

    public function update($id)
    {
        $this->partId = $id;
        $item = Part::query()->findOrFail($this->partId);
        $this->purchase_price = $item->purchase_price;
        $this->dispatchBrowserEvent('show-edit-model');
    }

    public function saveUpadte(): void
    {
        $this->validateOnly('purchase_price');
        Part::query()->findOrFail($this->partId)->update(['purchase_price' => $this->purchase_price]);
        $this->notify('info', trans('public.update'));
        $this->dispatchBrowserEvent('hide-edit-model');
        $this->reset();
    }
}
