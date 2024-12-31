<?php

namespace App\Http\Livewire\Services;

use App\Models\Part;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class PartsPage extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $search;

    public $arName;

    public $enName;

    public $image;

    public $sale_price;

    public $purchase_price;

    public $notes;

    public $partId;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'refreshParent' => '$refresh',
    ];
    protected $rules = [
        'arName' => 'required|string|max:250',
        'enName' => 'required|string|max:250',
        'sale_price' => 'required|numeric',
        'purchase_price' => 'required|numeric|min:0',
    ];

    public function render()
    {
        return view('livewire.services.parts-page', [
            'parts' => Part::query()
                ->with('user:id,name')
                ->withSum('purchases', 'part_purchase.quantity')
                ->withSum('invoices', 'invoice_part.quantity')
                ->mySearch($this->search)->latest()->paginate(10),
        ]);
    }

    public function add(): void
    {
        $this->reset();
        $this->dispatchBrowserEvent('show-create-model');
    }

    public function update($id)
    {
        $this->partId = $id;
        $item = Part::query()->findOrFail($this->partId);
        $this->arName = $item->arName;
        $this->enName = $item->enName;
        $this->image = $item->image;
        $this->sale_price = $item->sale_price;
        $this->purchase_price = $item->purchase_price;
        $this->notes = $item->notes;
        $this->dispatchBrowserEvent('show-edit-model');
    }

    public function saveUpadte()
    {
        if ($this->sale_price <= $this->purchase_price) {
            $this->notify('warning', trans('public.theSalePriceMustBeBiggerThanPurchasePrice'));

            return;
        }
        $this->validate();
        $this->addPart(false, $this->partId);
        $this->notify('info', trans('public.update'));
        $this->dispatchBrowserEvent('hide-edit-model');
        $this->reset();
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

    public function save()
    {
        $this->validate();
        if ($this->sale_price <= $this->purchase_price) {
            $this->notify('warning', trans('public.theSalePriceMustBeBiggerThanPurchasePrice'));
            return;
        }
        $this->addPart(true, null);
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-create-model');
        $this->reset();
    }

    public function remove($id)
    {
        $this->partId = $id;
        $this->dispatchBrowserEvent('show-delete-model');
    }

    public function delete()
    {
        $item = Part::query()->findOrFail($this->partId);
        if ($item->image) {
            unlink($item->image);
        }
        $item->delete();
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-delete-model');
        $this->partId = null;
        $this->reset();
    }
}
