<?php

namespace App\Http\Livewire\Expense;

use App\Models\ExpenseCategory;
use App\Models\ExpenseSubCategory;
use Livewire\Component;
use Livewire\WithPagination;

class ExpensesSubCategories extends Component
{
    use WithPagination;

    public $arName;

    public $enName;

    public $search;

    public $category;

    public $expenseId;

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
                $this->items = ExpenseCategory::orderBy('arName', 'asc')->pluck('arName', 'id');
            } else {
                $this->items = ExpenseCategory::orderBy('enName', 'asc')->pluck('enName', 'id');
            }
        }

        return $this->items;
    }

    public function render()
    {
        return view('livewire.expense.expenses-sub-categories', [
            'expenses' => ExpenseSubCategory::query()->with('category')->mySearch($this->search)->latest()->paginate(10),
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
        $item = ExpenseSubCategory::query()->findOrFail($this->expenseId);
        $this->arName = $item->arName;
        $this->enName = $item->enName;
        $this->category = $item->expense_category_id;
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
            $item = new ExpenseSubCategory();
            $item->arName = $this->arName;
            $item->enName = $this->enName;
            $item->expense_category_id = $this->category;
            $item->save();
        } else {
            $item = ExpenseSubCategory::query()->findOrFail($id);
            $item->arName = $this->arName;
            $item->enName = $this->enName;
            $item->expense_category_id = $this->category;
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
        ExpenseSubCategory::query()->findOrFail($this->expenseId)->delete();
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-delete-model');
        $this->expenseId = null;
        $this->reset();
    }
}
