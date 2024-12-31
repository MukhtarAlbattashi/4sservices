<?php

namespace App\Http\Livewire\Salary;

use App\Models\Salary;
use Livewire\Component;
use Livewire\WithPagination;

class SalariesPage extends Component
{
    use WithPagination;

    public $search;

    public $userId;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.salary.salaries-page', [
            'salaries' => Salary::query()->with('employee')->mySearch($this->search)->latest()->paginate(10),
        ]);
    }

    public function remove($id)
    {
        $this->userId = $id;
        $this->dispatchBrowserEvent('show-delete-model');
    }

    public function delete()
    {
        Salary::query()->findOrFail($this->userId)->delete();
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-delete-model');
        $this->userId = null;
        $this->reset();
    }
}
