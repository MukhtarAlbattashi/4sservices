<?php

namespace App\Http\Livewire\Contract;

use App\Models\Contract;
use Livewire\Component;
use Livewire\WithPagination;

class ContractsPage extends Component
{
    use WithPagination;

    public $search;

    public $userId;

    public $validOnly = false;

    protected $paginationTheme = 'bootstrap';

    public function updatedValidOnly()
    {
        $this->resetPage();
    }

    public function render()
    {
        $contractsQuery = Contract::query()->with('employee')->mySearch($this->search);
        if ($this->validOnly) {
            $contractsQuery = $contractsQuery->whereDate('endDateContract', '>=', now());
        }

        return view('livewire.contract.contracts-page', [
            'contracts' => $contractsQuery->latest()->paginate(10),
        ]);
    }

    public function remove($id)
    {
        $this->userId = $id;
        $this->dispatchBrowserEvent('show-delete-model');
    }

    public function delete()
    {
        Contract::query()->findOrFail($this->userId)->delete();
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-delete-model');
        $this->userId = null;
        $this->reset();
    }
}
