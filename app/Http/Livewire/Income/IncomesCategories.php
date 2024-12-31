<?php

namespace App\Http\Livewire\Income;

use App\Models\IncomeCategory;
use Livewire\Component;
use Livewire\WithPagination;

class IncomesCategories extends Component
{
    use WithPagination;

    public $arName;

    public $enName;

    public $search;

    public $expenseId;

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'arName' => 'required',
        'enName' => 'required',
    ];

    public function render()
    {
        return view('livewire.income.incomes-categories', [
            'expenses' => IncomeCategory::query()->mySearch($this->search)->latest()->paginate(10),
        ]);
    }

    public function add(): void
    {
        $this->reset();
        $this->dispatchBrowserEvent('show-create-model');
    }

    public function update($id)
    {
        $this->expenseId = $id;
        $item = IncomeCategory::query()->findOrFail($this->expenseId);
        $this->arName = $item->arName;
        $this->enName = $item->enName;
        $this->dispatchBrowserEvent('show-edit-model');
    }

    public function saveUpdate()
    {
        $this->validate();
        $this->item(false, $this->expenseId);
        $this->notify('info', trans('public.update'));
        $this->dispatchBrowserEvent('hide-edit-model');
        $this->reset();
    }

    private function item(bool $new, $id)
    {
        if ($new) {
            $item = new IncomeCategory();
            $item->arName = $this->arName;
            $item->enName = $this->enName;
            $item->save();
        } else {
            $item = IncomeCategory::query()->findOrFail($id);
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
        $this->expenseId = $id;
        $this->dispatchBrowserEvent('show-delete-model');
    }

    public function delete()
    {
        IncomeCategory::query()->findOrFail($this->expenseId)->delete();
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-delete-model');
        $this->expenseId = null;
        $this->reset();
    }
}
