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

class EditPurchasesPage extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $search;

    public $purchase;

    public $arName;

    public $enName;

    public $image;

    public $sale_price;

    public $purchase_price;

    public $notify;

    public $notes;

    public $store = 0;

    public $partId;

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

    protected $suppliers;

    protected $rules = [
        'arName' => 'required',
        'enName' => 'required',
        'sale_price' => 'required',
        'purchase_price' => 'required',
        'notify' => 'required',
    ];

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount($id)
    {
        $this->gtax = Setting::query()->first()->value('tax');
        $this->tax = $this->gtax;
        $this->purchase = Purchase::query()->find($id);
        foreach ($this->purchase->parts as $part) {
            $part->makeHidden('pivot');
            $this->addedParts[] = $part->toArray();
            $this->quantity[] = $part->pivot->quantity;
        }
        $this->supplier = $this->purchase->supplier->id;
        $this->tax = $this->purchase->tax;
        $this->discount = $this->purchase->discount;
        $this->date = date('Y-m-d', strtotime($this->purchase->date));
        $this->calcTotalPrice();
    }

    public function calcTotalPrice()
    {
        $this->subTotal = 0;
        $i = 0;
        foreach ($this->addedParts as $part) {
            if (isset($this->quantity) && ! empty($this->quantity)) {
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

    public function render()
    {
        return view('livewire.purchases.edit-purchases-page', [
            'parts' => Part::query()->withSum('purchases', 'part_purchase.quantity')->mySearch($this->search)->latest()->paginate(10),
        ]);
    }

    public function addToInvoice($part)
    {
        if (! in_array($part, $this->addedParts)) {
            $this->addedParts[] = $part;
            $this->quantity[] = 1;
            $this->notify('success', trans('public.success'));
            $this->calcTotalPrice();
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
        $this->calcTotalPrice();
    }

    public function updatedTax()
    {
        if ($this->tax == null || floatval($this->tax) < 0 || ! is_numeric(floatval($this->tax))) {
            $this->tax = 0;
        }
        $this->calcTotalPrice();
    }

    public function updatedDiscount()
    {
        if ($this->discount === null || floatval($this->discount) < 0 || ! is_numeric(floatval($this->discount))) {
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
        $purchase = Purchase::query()->find($this->purchase->id);
        $purchase->sub_total = $this->subTotal;
        $purchase->tax = $this->tax;
        $purchase->discount = $this->discount;
        $purchase->total = $this->totalPrice;
        $purchase->date = $this->date;
        $purchase->supplier_id = $this->supplier;
        $purchase->user_id = Auth::id();
        $purchase->save();
        $purchase->parts()->detach();
        foreach ($this->addedParts as $index => $part) {
            $purchase->parts()->attach($part['id'], ['quantity' => $this->quantity[$index]]);
        }
        $this->notify('success', trans('public.success'));
        $this->reset();
        to_route('purchases');
    }

    public function save()
    {
        $this->validate();
        $this->addPart(true, null);
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-create-model');
    }

    private function addPart(bool $new, $id): void
    {
        $item = $new ? new Part() : Part::query()->findOrFail($id);
        $item->user_id = Auth::id();
        $item->arName = $this->arName;
        $item->enName = $this->enName;
        $item->sale_price = $this->sale_price;
        $item->purchase_price = $this->purchase_price;
        $item->notes = $this->notes;
        if ($this->image) {
            if (!$new && $item->image) {
                Storage::disk('public')->delete(str_replace('storage/', '', $item->image));
            }
            $path = $this->image->store('photo', 'public');
            $item->image = 'storage/'.$path;
        }
        $item->save();
    }

    public function UpdatedQuantity()
    {
        foreach ($this->quantity as $index => $value) {
            if (floatval($this->quantity[$index]) <= 0 || floatval($this->quantity[$index]) == null || ! is_numeric(floatval($this->quantity[$index]))) {
                $this->quantity[$index] = 1;
            }
        }
        $this->calcTotalPrice();
    }

    public function add()
    {
        // $this->resetExcept('addedParts');
    }

    public function update($id)
    {
        $this->partId = $id;
        $item = Part::query()->findOrFail($this->partId);
        $this->purchase_price = $item->purchase_price;
        $this->dispatchBrowserEvent('show-edit-model');
    }

    public function saveUpadte()
    {
        $this->validateOnly('purchase_price');
        $this->addPart(false, $this->partId);
        $this->notify('info', trans('public.update'));
        $this->dispatchBrowserEvent('hide-edit-model');
    }
}
