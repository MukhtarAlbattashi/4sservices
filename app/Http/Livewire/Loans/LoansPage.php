<?php

namespace App\Http\Livewire\Loans;

use App\Models\Loan;
use Livewire\Component;
use Livewire\WithPagination;

class LoansPage extends Component
{
    use WithPagination;

    public $search;

    public $loanId;

    public $name;

    public $from;

    public $to;

    public $amount;

    public $active;

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'name' => 'required|string|max:255',
        'from' => 'required|date',
        'to' => 'required|date',
        'amount' => 'required|numeric',
    ];

    public function render()
    {
        return view('livewire.loans.loans-page', [
            'loans' => Loan::query()->mySearch($this->search)->latest()->paginate(10),
        ]);
    }

    public function add(): void
    {
        $this->reset();
        $this->dispatchBrowserEvent('show-create-model');
    }

    public function update($id)
    {
        $this->loanId = $id;
        $item = Loan::query()->findOrFail($this->loanId);
        $this->name = $item->name;
        $this->from = $item->from;
        $this->to = $item->to;
        $this->amount = $item->amount;
        $this->active = $item->active;
        $this->dispatchBrowserEvent('show-edit-model');
    }

    public function saveUpdate()
    {
        $this->validate();
        $this->item(false, $this->loanId);
        $this->notify('info', trans('public.update'));
        $this->dispatchBrowserEvent('hide-edit-model');
        $this->reset();
    }

    private function item(bool $new, $id)
    {
        $item = $new ? new Loan() : Loan::query()->findOrFail($id);
        $item->name = $this->name;
        $item->from = $this->from;
        $item->to = $this->to;
        $item->amount = $this->amount;
        $item->active = $this->active ?? false;
        $item->save();
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
        $this->loanId = $id;
        $this->dispatchBrowserEvent('show-delete-model');
    }

    public function delete()
    {
        Loan::query()->findOrFail($this->loanId)->delete();
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-delete-model');
        $this->loanId = null;
        $this->reset();
    }
}
