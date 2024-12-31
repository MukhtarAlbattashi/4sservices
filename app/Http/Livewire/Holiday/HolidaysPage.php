<?php

namespace App\Http\Livewire\Holiday;

use App\Models\Holiday;
use Livewire\Component;
use Livewire\WithPagination;

class HolidaysPage extends Component
{
    use WithPagination;

    public $search;

    public $userId;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.holiday.holidays-page', [
            'holidays' => Holiday::query()->with('employeeInfo', 'category')->mySearch($this->search)->latest()->paginate(10),
        ]);
    }

    public function remove($id)
    {
        $this->userId = $id;
        $this->dispatchBrowserEvent('show-delete-model');
    }

    public function delete()
    {
        Holiday::query()->findOrFail($this->userId)->delete();
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-delete-model');
        $this->userId = null;
        $this->reset();
    }
}
