<?php

namespace App\Http\Livewire\Discounts;

use App\Models\DiscountCategory;
use Livewire\Component;
use Livewire\WithPagination;

class DiscountsCategories extends Component
{
    use WithPagination;

    public $arName;

    public $enName;

    public $search;

    public $partId;

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'arName' => 'required',
        'enName' => 'required',
    ];

    public function render()
    {
        return view('livewire.discounts.discounts-categories', [
            'expenses' => DiscountCategory::query()->withCount('discounts')->mySearch($this->search)->latest()->paginate(10),
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
        $item = DiscountCategory::query()->findOrFail($this->partId);
        $this->arName = $item->arName;
        $this->enName = $item->enName;
        $this->dispatchBrowserEvent('show-edit-model');
    }

    public function saveUpdate()
    {
        $this->validate();
        $this->item(false, $this->partId);
        $this->notify('info', trans('public.update'));
        $this->dispatchBrowserEvent('hide-edit-model');
        $this->reset();
    }

    private function item(bool $new, $id)
    {
        if ($new) {
            $item = new DiscountCategory();
            $item->arName = $this->arName;
            $item->enName = $this->enName;
            $item->save();
        } else {
            $item = DiscountCategory::query()->findOrFail($id);
            $item->arName = $this->arName;
            $item->enName = $this->enName;
            $item->save();
        }
    }

    public function save()
    {
        $this->validate();
        $this->item(true, null);
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
        DiscountCategory::query()->findOrFail($this->partId)->delete();
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-delete-model');
        $this->partId = null;
        $this->reset();
    }
}