<?php

namespace App\Http\Livewire\Income;

use App\Models\Income;
use App\Models\IncomeCategory;
use App\Models\IncomeSubCategory;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class IncomePage extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $search;

    public $category;

    public $subCategory;

    public $payment;

    public $incomeId;

    public $income_him;

    public $amount;

    public $date;

    public $check;

    public $attach;

    public $about;

    public $notes;

    protected $paginationTheme = 'bootstrap';

    protected $categories;

    protected $subCategories;

    protected $payments;

    protected $rules = [
        'payment' => 'required',
        'category' => 'required',
        'subCategory' => 'required',
        'income_him' => 'required',
        'amount' => 'required|numeric|min:0',
        'date' => 'required|date',
        'about' => 'required',
        'check' => 'required',
    ];

    public function getCategories()
    {
        if ($this->categories == null) {
            if (app()->getLocale() == 'ar') {
                $this->categories = IncomeCategory::orderBy('arName', 'asc')->pluck('arName', 'id');
            } else {
                $this->categories = IncomeCategory::orderBy('enName', 'asc')->pluck('enName', 'id');
            }
        }

        return $this->categories;
    }

    public function getPayments()
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

    public function updatedCategory()
    {
        $this->getSubCategories();
    }

    public function getSubCategories()
    {
        if ($this->category != null) {
            if (app()->getLocale() == 'ar') {
                $this->subCategories = IncomeSubCategory::where('income_category_id', $this->category)->orderBy('arName', 'asc')->pluck('arName', 'id');
            } else {
                $this->subCategories = IncomeSubCategory::where('income_category_id', $this->category)->orderBy('enName', 'asc')->pluck('enName', 'id');
            }
        } else {
            $this->subCategories = [];
        }

        return $this->subCategories;
    }

    public function render()
    {
        $this->date = date('Y-m-d', strtotime(now()));

        return view('livewire.income.income-page', [
            'incomes' => Income::query()->with('category', 'subCategory', 'payment', 'user')->mySearch($this->search)->latest()->paginate(10),
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
        $item = Income::query()->findOrFail($this->incomeId);
        $this->income_him = $item->income_him;
        $this->amount = $item->amount;
        $this->date = $item->date;
        $this->check = $item->check;
        $this->attach = $item->attach;
        $this->about = $item->about;
        $this->notes = $item->notes;
        $this->category = $item->income_category_id;
        $this->subCategory = $item->income_sub_category_id;
        $this->payment = $item->payment_id;
        $this->attach = $item->attach;
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
            $item = new Income();
            $item->income_him = $this->income_him;
            $item->amount = $this->amount;
            $item->date = $this->date;
            $item->check = $this->check;
            $item->attach = $this->attach;
            $item->about = $this->about;
            $item->notes = $this->notes;
            $item->income_category_id = $this->category;
            $item->income_sub_category_id = $this->subCategory;
            $item->payment_id = $this->payment;
            $item->user_id = Auth::id();
            if ($this->attach) {
                $path = $this->attach->store('file', 'public');
                $item->attach = 'storage/'.$path;
            }
            $item->save();
        } else {
            $item = Income::query()->findOrFail($id);
            $item->income_him = $this->income_him;
            $item->amount = $this->amount;
            $item->date = $this->date;
            $item->check = $this->check;
            $item->about = $this->about;
            $item->notes = $this->notes;
            $item->income_category_id = $this->category;
            $item->income_sub_category_id = $this->subCategory;
            $item->payment_id = $this->payment;
            $item->user_id = Auth::id();
            if ($this->attach != $item->attach) {
                if ($item->attach) {
                    unlink($item->attach);
                }
                $path = $this->attach->store('file', 'public');
                $item->attach = 'storage/'.$path;
            }
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
        $item = Income::query()->findOrFail($this->incomeId);
        if ($item->attach) {
            unlink($item->attach);
        }
        $item->delete();
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-delete-model');
        $this->incomeId = null;
        $this->reset();
    }
}
