<?php

namespace App\Http\Livewire\Expense;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\ExpenseSubCategory;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ExpensePage extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $search;
    public $searchCurrentMonth;

    public $category;

    public $subCategory;

    public $payment;

    public $expenseId;

    public $expense_him;

    public $amount;

    public $tax;

    public $amount_tax;

    public $date;

    public $check;

    public $attach;

    public $about;

    public $notes;

    public $monthly = false;

    protected $paginationTheme = 'bootstrap';

    protected $categories;

    protected $subCategories;

    protected $payments;

    protected $rules = [
        'payment' => 'required',
        'category' => 'required',
        'subCategory' => 'required',
        'expense_him' => 'required',
        'amount' => 'required|numeric|min:0',
        'tax' => 'required|numeric|min:0',
        'amount_tax' => 'required|numeric',
        'date' => 'required|date',
        'about' => 'required',
    ];

    public function getCategories(): \Illuminate\Support\Collection
    {
        if ($this->categories == null) {
            if (app()->getLocale() == 'ar') {
                $this->categories = ExpenseCategory::orderBy('arName', 'asc')->pluck('arName', 'id');
            } else {
                $this->categories = ExpenseCategory::orderBy('enName', 'asc')->pluck('enName', 'id');
            }
        }

        return $this->categories;
    }

    public function getPayments(): \Illuminate\Support\Collection
    {
        if ($this->payments == null) {
            if (app()->getLocale() == 'ar') {
                $this->payments = Payment::orderBy('arName', 'asc')->pluck('arName', 'id');
            } else {
                $this->payments = Payment::orderBy('enName', 'asc')->pluck('enName', 'id');
            }
        }

        return $this->payments;
    }

    public function updatedCategory(): void
    {
        $this->getSubCategories();
    }

    public function getSubCategories(): array|\Illuminate\Support\Collection
    {
        if ($this->category != null) {
            if (app()->getLocale() == 'ar') {
                $this->subCategories = ExpenseSubCategory::where('expense_category_id',
                    $this->category)->orderBy('arName', 'asc')->pluck('arName', 'id');
            } else {
                $this->subCategories = ExpenseSubCategory::where('expense_category_id',
                    $this->category)->orderBy('enName', 'asc')->pluck('enName', 'id');
            }
        } else {
            $this->subCategories = [];
        }

        return $this->subCategories;
    }

    public function updatedAmount(): void
    {
        if ($this->tax != 0 && $this->tax != null) {
            $this->amount_tax = $this->amount + ($this->amount * ($this->tax / 100));
        } else {
            $this->amount_tax = $this->amount;
        }
    }

    public function updatedTax(): void
    {
        if ($this->tax != 0 && $this->tax != null) {
            $this->amount_tax = $this->amount + ($this->amount * ($this->tax / 100));
        } else {
            $this->amount_tax = $this->amount;
        }
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.expense.expense-page', [
            'expenses' => Expense::query()
                ->where('monthly', false)
                ->whereDate('date', '<=', now()->startOfMonth()->subDay()->format('Y-m-d'))
                ->with(['category', 'subCategory', 'payment', 'user'])
                ->mySearch($this->search)
                ->latest()
                ->paginate(10),
            'currentMonth' => Expense::query()
                ->where('monthly', false)
                ->whereDate('date', '>=', now()->startOfMonth()->format('Y-m-d'))
                ->whereDate('date', '<=', now()->endOfMonth()->format('Y-m-d'))
                ->with(['category', 'subCategory', 'payment', 'user'])
                ->latest()
                ->get(),
            'monthlyExpenses' => Expense::query()
                ->where('monthly', true)
                ->with(['category', 'subCategory', 'payment', 'user'])
                ->latest()
                ->get(),
        ]);
    }

    public function add(): void
    {
        $this->reset();
        $this->date = date('Y-m-d');
        $this->dispatchBrowserEvent('show-create-model');
    }

    public function update($id): void
    {
        $this->expenseId = $id;
        $item = Expense::query()->findOrFail($this->expenseId);
        $this->expense_him = $item->expense_him;
        $this->amount = $item->amount;
        $this->tax = $item->tax;
        $this->amount_tax = $item->amount_tax;
        $this->date = date('Y-m-d', strtotime($item->date));
        $this->check = $item->check;
        $this->attach = $item->attach;
        $this->about = $item->about;
        $this->notes = $item->notes;
        $this->monthly = $item->monthly;
        $this->category = $item->expense_category_id;
        $this->subCategory = $item->expense_sub_category_id;
        $this->payment = $item->payment_id;
        $this->dispatchBrowserEvent('show-edit-model');
    }

    public function saveUpdate(): void
    {
        $this->validate();
        $this->item(false, $this->expenseId);
        $this->notify('info', trans('public.update'));
        $this->dispatchBrowserEvent('hide-edit-model');
        $this->reset();

    }

    private function item(bool $new, $id): void
    {
        if ($new) {
            $item = new Expense();
            $item->expense_him = $this->expense_him;
            $item->amount = $this->amount;
            $item->tax = $this->tax;
            $item->amount_tax = $this->amount_tax;
            $item->date = $this->date;
            $item->check = $this->check;
            $item->attach = $this->attach;
            $item->about = $this->about;
            $item->notes = $this->notes;
            $item->monthly = $this->monthly;
            $item->expense_category_id = $this->category;
            $item->expense_sub_category_id = $this->subCategory;
            $item->payment_id = $this->payment;
            $item->user_id = Auth::id();
            if ($this->attach) {
                $path = $this->attach->store('file', 'public');
                $item->attach = 'storage/' . $path;
            }
            $item->save();
        } else {
            $item = Expense::query()->findOrFail($id);
            $item->expense_him = $this->expense_him;
            $item->amount = $this->amount;
            $item->tax = $this->tax;
            $item->amount_tax = $this->amount_tax;
            $item->date = $this->date;
            $item->check = $this->check;
            $item->about = $this->about;
            $item->notes = $this->notes;
            $item->monthly = $this->monthly;
            $item->expense_category_id = $this->category;
            $item->expense_sub_category_id = $this->subCategory;
            $item->payment_id = $this->payment;
            $item->user_id = Auth::id();
            if ($this->attach != $item->attach) {
                if ($item->attach) {
                    unlink($item->attach);
                }
                $path = $this->attach->store('file', 'public');
                $item->attach = 'storage/' . $path;
            }
            $item->save();
        }
    }

    public function save(): void
    {
        $this->validate();
        $this->item(true, null);
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-create-model');
        $this->reset();

    }

    public function remove($id): void
    {
        $this->expenseId = $id;
        $this->dispatchBrowserEvent('show-delete-model');
    }

    public function delete(): void
    {
        $item = Expense::query()->findOrFail($this->expenseId);
        if ($item->attach) {
            unlink($item->attach);
        }
        $item->delete();
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-delete-model');
        $this->expenseId = null;
        $this->reset();
    }
}
