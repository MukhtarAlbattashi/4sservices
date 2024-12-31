<?php

namespace App\Http\Livewire\Discounts;

use App\Models\Discount;
use Livewire\Component;

class DiscountPage extends Component
{
    public $search;

    public $userId;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.discounts.discount-page', [
            'discounts' => Discount::query()->with('employeeInfo', 'category')->mySearch($this->search)->latest()->paginate(10),
        ]);
    }

    public function remove($id)
    {
        $this->userId = $id;
        $this->dispatchBrowserEvent('show-delete-model');
    }

    public function delete()
    {
        Discount::query()->findOrFail($this->userId)->delete();
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-delete-model');
        $this->userId = null;
        $this->reset();
    }
}
