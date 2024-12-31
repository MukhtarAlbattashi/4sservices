<?php

namespace App\Http\Livewire\Cars;

use App\Models\RegistrationType;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class RegistrationsType extends Component
{
    use WithPagination;

    public $search;

    public $arName;
    public $enName;


    public $registrationTypeId;

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'arName' => 'required|string|max:250',
        'enName' => 'required|string|max:250',
    ];

    public function render()
    {
        return view('livewire.cars.registrations-type', [
            'cars' => RegistrationType::query()
                ->withCount('cars')
                ->with('user:id,name')
                ->mySearch($this->search)
                ->latest()
                ->paginate(10),
        ]);
    }

    public function update($id): void
    {
        $this->registrationTypeId = $id;
        $car = RegistrationType::query()->findOrFail($this->registrationTypeId);
        $this->arName = $car->arName;
        $this->enName = $car->enName;
        $this->dispatchBrowserEvent('show-edit-model');
    }

    public function updateCar(): void
    {
        $this->validate();
        $this->car(false, $this->registrationTypeId);
        $this->notify('info', trans('public.update'));
        $this->dispatchBrowserEvent('hide-edit-model');
        $this->reset();
    }

    private function car(bool $new, $id): void
    {
        $car = $new ? new RegistrationType() : RegistrationType::query()->findOrFail($id);
        $car->user_id = Auth::id();
        $car->arName = $this->arName;
        $car->enName = $this->enName;
        $car->save();
    }

    public function save(): void
    {
        $this->validate();
        $this->car(true, null);
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-create-model');
        $this->reset();
    }

    public function remove($id): void
    {
        $this->registrationTypeId = $id;
        $this->dispatchBrowserEvent('show-delete-model');
    }

    public function delete(): void
    {
        RegistrationType::query()->findOrFail($this->registrationTypeId)->delete();
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-delete-model');
        $this->registrationTypeId = null;
        $this->reset();
    }
}
