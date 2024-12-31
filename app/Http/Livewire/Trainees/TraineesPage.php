<?php

namespace App\Http\Livewire\Trainees;

use App\Models\Trainee;
use Livewire\Component;
use Livewire\WithPagination;

class TraineesPage extends Component
{
    use WithPagination;

    public $search;

    public $userId;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.trainees.trainees-page', [
            'users' => Trainee::query()->mySearch($this->search)->latest()->paginate(10),
        ]);
    }

    public function remove($id)
    {
        $this->userId = $id;
        $this->dispatchBrowserEvent('show-delete-model');
    }

    public function delete()
    {
        Trainee::query()->findOrFail($this->userId)->delete();
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-delete-model');
        $this->userId = null;
        $this->reset();
    }
}
