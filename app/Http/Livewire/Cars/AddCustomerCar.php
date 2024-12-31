<?php

namespace App\Http\Livewire\Cars;

use App\Models\Car;
use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\Customer;
use App\Models\RegistrationType;
use Exception;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class AddCustomerCar extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $search;

    public $customer;

    public $brand;

    public $model;

    public $type;

    public Car $car;

    public $attach;

    public $other;

    protected $paginationTheme = 'bootstrap';

    protected $brands;

    protected $models;

    protected $types;

    protected $rules = [
        'car.owner' => ['required', 'string', 'max:255'],
        'car.owner_id' => ['nullable', 'numeric', 'max_digits:15'],
        'car.number' => ['required', 'numeric', 'max:9999999', 'min:0'],
        'car.letter' => ['required', 'string', 'min:0'],
        'car.color' => ['required', 'string', 'max:255'],
        'car.year' => ['required', 'numeric', 'digits:4', 'min:1960', 'max:3000'],
        'car.chassis' => ['required', 'string', 'max:255'],
        'car.cylinders' => ['required', 'numeric', 'min:0', 'max:20', 'max_digits:2'],
        'car.notes' => ['nullable', 'string', 'max:255'],
        'car.attach' => ['nullable', 'max:3072'],
        'car.other' => ['nullable', 'max:3072'],
        'customer' => ['required'],
        'brand' => ['required', 'exists:car_brands,id'],
        'model' => ['required', 'exists:car_models,id'],
        'type' => ['required', 'exists:registration_types,id'],
    ];

    public function mount($customerId): void
    {
        $this->car = new Car();
        $this->customer = Customer::query()->findOrFail($customerId);
    }

    public function getBrands()
    {
        if ($this->brands == null) {
            if (app()->getLocale() == 'ar') {
                $this->brands = CarBrand::orderBy('arName')->pluck('arName', 'id');
            } else {
                $this->brands = CarBrand::orderBy('enName')->pluck('enName', 'id');
            }
        }

        return $this->brands;
    }

    public function getTypes()
    {
        if ($this->types == null) {
            if (app()->getLocale() == 'ar') {
                $this->types = RegistrationType::orderBy('arName')->pluck('arName', 'id');
            } else {
                $this->types = RegistrationType::orderBy('enName')->pluck('enName', 'id');
            }
        }

        return $this->types;
    }

    public function updatedBrand(): void
    {
        $this->getModels();
    }

    public function getModels()
    {
        if ($this->brands != null) {
            if (app()->getLocale() == 'ar') {
                $this->models = CarModel::where('car_brand_id', $this->brand)->orderBy('arName')->pluck('arName',
                    'id');
            } else {
                $this->models = CarModel::where('car_brand_id', $this->brand)->orderBy('enName')->pluck('enName',
                    'id');
            }
        } else {
            $this->models = [];
        }

        return $this->models;
    }

    public function render()
    {
        return view('livewire.cars.add-customer-car');
    }

    public function save()
    {
        $this->validate();
        try {
            if ($this->attach !=null) {
                $path = $this->attach->store('file', 'public');
                $this->car->attach = 'storage/'.$path;
            }
            if ($this->other !=null) {
                $path = $this->other->store('file', 'public');
                $this->car->other = 'storage/'.$path;
            }
            $this->car->user_id = auth()->id();
            $this->car->customer_id = $this->customer->id;
            $this->car->car_brand_id = $this->brand;
            $this->car->car_model_id = $this->model;
            $this->car->registration_type_id = $this->type;
            $this->car->save();
            $this->reset(['brand', 'model', 'type']);
            $this->notify('success', trans('public.success'));
            return redirect()->route('vehicles');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $this->notify('danger', trans('public.error'));
        }
    }

}
