<?php

namespace App\Http\Livewire\Services;

use App\Models\Part;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddParts extends Component
{
    use WithFileUploads;

    public Part $part;

    protected $rules = [
        'part.arName' => 'required|string|max:250',
        'part.enName' => 'required|string|max:250',
        'part.notes' => 'nullable|string|max:250',
        'part.image' => 'nullable|image|max:250',
        'part.sale_price' => 'required|numeric|min:0',
        'part.purchase_price' => 'required|numeric|min:0',
    ];

    public function mount(): void
    {
        $this->part = new Part();
    }

    public function render()
    {
        return view('livewire.services.add-parts');
    }


    public function save()
    {
        $this->validate();
        if ($this->part->sale_price <= $this->part->purchase_price) {
            $this->notify('warning', trans('public.theSalePriceMustBeBiggerThanPurchasePrice'));
            return;
        }
        if ($this->part->image) {
            $path = $this->part->image->store('photo', 'public');
            $this->part->image = 'storage/'.$path;
        }
        $this->part->user_id = Auth::id();
        $this->part->save();
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-create-model');
        $this->part = new Part();
        $this->emitUp('refreshParent');
    }

}
