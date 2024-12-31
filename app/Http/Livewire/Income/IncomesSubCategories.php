<?php

namespace App\Http\Livewire\Income;

use App\Models\IncomeCategory;
use App\Models\IncomeSubCategory;
use Livewire\Component;
use Livewire\WithPagination;

class IncomesSubCategories extends Component
{
    use WithPagination;

    public $arName;

    public $enName;

    public $search;

    public $category;

    public $incomeId;

    protected $paginationTheme = 'bootstrap';

    protected $items;

    protected $rules = [
        'arName' => 'required',
        'enName' => 'required',
        'category' => 'required',
    ];

    public function getOptions()
    {
        if ($this->items == null) {
            if (app()->getLocale() == 'ar') {
                $this->items = IncomeCategory::orderBy('arName', 'asc')->pluck('arName', 'id');
            } else {
                $this->items = IncomeCategory::orderBy('enName', 'asc')->pluck('enName', 'id');
            }
        }

        return $this->items;
    }

    public function render()
    {
        return view('livewire.income.incomes-sub-categories', [
            'expenses' => IncomeSubCategory::query()->with('category')->mySearch($this->search)->latest()->paginate(10),
        ]);
    }

    public function add(): void
    {
        $this->reset();
        $this->dispatchBrowserEvent('show-create-model');
    }

    public function update($id)
    {
        $this->incomeId = $id;
        $item = IncomeSubCategory::query()->findOrFail($this->incomeId);
        $this->arName = $item->arName;
        $this->enName = $item->enName;
        $this->category = $item->income_category_id;
        $this->dispatchBrowserEvent('show-edit-model');
    }

    public function saveUpdate()
    {
        $this->validate();
        $this->item(false, $this->incomeId);
        $this->notify('info', trans('public.update'));
        $this->dispatchBrowserEvent('hide-edit-model');
        $this->reset();
    }

    private function item(bool $new, $id)
    {
        if ($new) {
            $item = new IncomeSubCategory();
            $item->arName = $this->arName;
            $item->enName = $this->enName;
            $item->income_category_id = $this->category;
            $item->save();
        } else {
            $item = IncomeSubCategory::query()->findOrFail($id);
            $item->arName = $this->arName;
            $item->enName = $this->enName;
            $item->income_category_id = $this->category;
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
        $this->incomeId = $id;
        $this->dispatchBrowserEvent('show-delete-model');
    }

    public function delete()
    {
        IncomeSubCategory::query()->findOrFail($this->incomeId)->delete();
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-delete-model');
        $this->incomeId = null;
        $this->reset();
    }
}
