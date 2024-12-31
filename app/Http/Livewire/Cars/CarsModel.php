<?php

namespace App\Http\Livewire\Cars;

use App\Models\CarBrand;
use App\Models\CarModel;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class CarsModel extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $search;
    public $q;

    public $arName;

    public $enName;

    public $image;

    public $brand;

    public $CarModelId;

    protected $paginationTheme = 'bootstrap';

    protected $items;

    protected $rules = [
        'arName' => 'required|string|max:250',
        'enName' => 'required|string|max:250',
        'brand' => 'required|int|exists:car_brands,id',
        'image' => 'nullable|image',
    ];

    public function getOptions(): \Illuminate\Support\Collection
    {
        if ($this->items == null) {
            if (app()->getLocale() == 'ar') {
                $this->items = CarBrand::orderBy('arName', 'asc')->pluck('arName', 'id');
            } else {
                $this->items = CarBrand::orderBy('enName', 'asc')->pluck('enName', 'id');
            }
        }

        return $this->items;
    }

    public function render()
    {
        return view('livewire.cars.cars-model', [
            'cars' => CarModel::query()->withCount('cars')->with([
                'brand:id,arName,enName', 'user:id,name',
            ])->mySearch($this->search)->latest()->paginate(10),
        ]);
    }


    public function update($id): void
    {
        $this->CarModelId = $id;
        $car = CarModel::query()->findOrFail($this->CarModelId);
        $this->arName = $car->arName;
        $this->enName = $car->enName;
        $this->brand = $car->car_brand_id;
        $this->dispatchBrowserEvent('show-edit-model');
    }

    public function updateCar(): void
    {
        $this->validate();
        $this->car(false, $this->CarModelId);
        $this->notify('info', trans('public.update'));
        $this->dispatchBrowserEvent('hide-edit-model');
        $this->reset();
    }

    private function car(bool $new, $id): void
    {
        $car = $new ? new CarModel() : CarModel::query()->findOrFail($id);
        $car->user_id = Auth::id();
        $car->arName = $this->arName;
        $car->enName = $this->enName;
        $car->car_brand_id = $this->brand;
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
        $car = CarModel::query()->findOrFail($this->CarModelId);
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
            $this->CarModelId = null;
            $this->reset();
        }
    }

    public function resting(): void
    {
        $this->reset();
    }
}
