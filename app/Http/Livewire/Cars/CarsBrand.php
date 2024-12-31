<?php

namespace App\Http\Livewire\Cars;

use App\Models\CarBrand;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class CarsBrand extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $search;

    public $arName;

    public $enName;

    public $image;

    public $carBrandId;

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'arName' => 'required|string|max:250',
        'enName' => 'required|string|max:250',
        'image' => 'nullable|image',
    ];

    public function render()
    {
        return view('livewire.cars.cars-brand', [
            'cars' => CarBrand::query()
                ->withCount('cars')
                ->with('user:id,name')
                ->mySearch($this->search)
                ->latest()
                ->paginate(10),
        ]);
    }

    public function update($id): void
    {
        $this->carBrandId = $id;
        $car = CarBrand::query()->findOrFail($this->carBrandId);
        $this->arName = $car->arName;
        $this->enName = $car->enName;
        $this->dispatchBrowserEvent('show-edit-model');
    }

    public function updateCar(): void
    {
        $this->validate();
        $this->car(false, $this->carBrandId);
        $this->notify('info', trans('public.update'));
        $this->dispatchBrowserEvent('hide-edit-model');
        $this->reset();
    }

    private function car(bool $new, $id): void
    {
        $car = $new ? new CarBrand() : CarBrand::query()->findOrFail($id);
        $car->user_id = Auth::id();
        $car->arName = $this->arName;
        $car->enName = $this->enName;
        if ($this->image) {
            if (!$new && $car->image) {
                Storage::disk('public')->delete(str_replace('storage/', '', $car->image));
            }
            $path = $this->image->store('photo', 'public');
            $car->image = 'storage/'.$path;
        }
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

    public function delete(): void
    {
        $car = CarBrand::query()->findOrFail($this->carBrandId);
        try {
            if ($car->image) {
                unlink($car->image);
            }
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        } finally {
            $car->delete();
            $this->notify('success', trans('public.success'));
            $this->dispatchBrowserEvent('hide-delete-model');
            $this->carBrandId = null;
            $this->reset();
        }
    }
    public function resting(): void
    {
        $this->reset();
    }
}
