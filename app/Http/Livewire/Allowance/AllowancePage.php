<?php

namespace App\Http\Livewire\Allowance;

use App\Models\Allowance;
use Livewire\Component;

class AllowancePage extends Component
{
    public $search;

    public $userId;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.allowance.allowance-page', [
            'allowances' => Allowance::query()->with('employeeInfo', 'category')->mySearch($this->search)->latest()->paginate(10),
        ]);
    }

    public function remove($id)
    {
        $this->userId = $id;
        $this->dispatchBrowserEvent('show-delete-model');
    }

    public function delete()
    {
        Allowance::query()->findOrFail($this->userId)->delete();
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-delete-model');
        $this->userId = null;
        $this->reset();
    }
}
