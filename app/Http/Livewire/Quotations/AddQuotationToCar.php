<?php

namespace App\Http\Livewire\Quotations;

use App\Models\Car;
use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\Customer;
use App\Models\RegistrationType;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Request;

class AddQuotationToCar extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $search;

    public $customer;

    public $brand;

    public $model;

    public $type;

    public $carId;

    public $owner;

    public $owner_id;

    public $number;

    public $color = 'White / أبيض';

    public $year;

    public $chassis;

    public $cylinders;

    public $attach;

    public $other;

    public $notes;

    public $letter;

    protected $paginationTheme = 'bootstrap';

    protected $customers;

    protected $brands;

    protected $models;

    protected $types;

    protected $rules = [
        'owner' => ['required', 'string', 'max:255'],
        'owner_id' => ['nullable', 'numeric', 'max_digits:15'],
        'number' => ['required', 'numeric', 'max:9999999', 'min:0'],
        'letter' => ['required', 'string', 'min:0'],
        'color' => ['required', 'string', 'max:255'],
        'year' => ['required', 'numeric', 'digits:4', 'min:1990', 'max:3000'],
        'chassis' => ['required', 'string', 'max:255'],
        'cylinders' => ['required', 'numeric', 'min:0', 'max:20', 'max_digits:2'],
        'notes' => ['nullable', 'string', 'max:255'],
        'customer' => ['required', 'exists:customers,id'],
        'brand' => ['required', 'exists:car_brands,id'],
        'model' => ['required', 'exists:car_models,id'],
        'type' => ['required', 'exists:registration_types,id'],
    ];

    public function mount()
    {
        $this->search = Request::query('search', '');
    }

    public function getCustomers()
    {
        if ($this->customers == null) {
            $this->customers = Customer::orderBy('name', 'asc')->select('id', 'name', 'phone')->get();
        }

        return $this->customers;
    }

    public function getBrands()
    {
        if ($this->brands == null) {
            if (app()->getLocale() == 'ar') {
                $this->brands = CarBrand::orderBy('arName', 'asc')->pluck('arName', 'id');
            } else {
                $this->brands = CarBrand::orderBy('enName', 'asc')->pluck('enName', 'id');
            }
        }

        return $this->brands;
    }

    public function getTypes()
    {
        if ($this->types == null) {
            if (app()->getLocale() == 'ar') {
                $this->types = RegistrationType::orderBy('arName', 'asc')->pluck('arName', 'id');
            } else {
                $this->types = RegistrationType::orderBy('enName', 'asc')->pluck('enName', 'id');
            }
        }

        return $this->types;
    }

    public function updatedBrand()
    {
        $this->getModels();
    }

    public function getModels()
    {
        if ($this->brands != null) {
            if (app()->getLocale() == 'ar') {
                $this->models = CarModel::where('car_brand_id', $this->brand)->orderBy('arName', 'asc')->pluck('arName', 'id');
            } else {
                $this->models = CarModel::where('car_brand_id', $this->brand)->orderBy('enName', 'asc')->pluck('enName', 'id');
            }
        } else {
            $this->models = [];
        }

        return $this->models;
    }

    public function render()
    {
        return view('livewire.quotations.add-quotation-to-car', [
            'cars' => Car::query()->with(
                'customer:id,name,phone',
                'model:id,arName,enName',
                'brand:id,arName,enName',
                'type:id,arName,enName',
                'user:id,name'
            )
                ->withCount('invoices')
                ->withSum('invoices', 'total')
                ->withSum('payments', 'amount')
                ->mySearch($this->search)
                ->latest()
                ->paginate(10),
        ]);
    }

    public function add(): void
    {
        $this->reset();
        $this->dispatchBrowserEvent('show-create-model');
    }

    public function update($id)
    {
        $this->carId = $id;
        $item = Car::query()->findOrFail($this->carId);
        $this->number = $item->number;
        $this->letter = $item->letter;
        $this->owner = $item->owner;
        $this->owner_id = $item->owner_id;
        $this->color = $item->color;
        $this->year = $item->year;
        $this->chassis = $item->chassis;
        $this->cylinders = $item->cylinders;
        $this->notes = $item->notes;
        $this->customer = $item->customer_id;
        $this->brand = $item->car_brand_id;
        $this->model = $item->car_model_id;
        $this->type = $item->registration_type_id;
        $this->dispatchBrowserEvent('show-edit-model');
    }

    public function saveUpdate()
    {
        $this->validate();
        $this->item(false, $this->carId);
        $this->notify('info', trans('public.update'));
        $this->dispatchBrowserEvent('hide-edit-model');
        $this->reset();
    }

    private function item(bool $new, $id)
    {
        if ($new) {
            $item = new Car();
            $item->number = $this->number;
            $item->letter = $this->letter;
            $item->owner = $this->owner;
            $item->owner_id = $this->owner_id;
            $item->color = $this->color;
            $item->year = $this->year;
            $item->chassis = $this->chassis;
            $item->cylinders = $this->cylinders;
            $item->notes = $this->notes;
            $item->customer_id = $this->customer;
            $item->car_brand_id = $this->brand;
            $item->car_model_id = $this->model;
            $item->registration_type_id = $this->type;
            $item->user_id = Auth::id();
            if ($this->attach) {
                $path = $this->attach->store('file', 'public');
                $item->attach = 'storage/'.$path;
            }
            if ($this->other) {
                $path = $this->other->store('file', 'public');
                $item->other = 'storage/'.$path;
            }
            $item->save();
        } else {
            $item = Car::query()->findOrFail($id);
            $item->number = $this->number;
            $item->letter = $this->letter;
            $item->owner = $this->owner;
            $item->owner_id = $this->owner_id;
            $item->color = $this->color;
            $item->year = $this->year;
            $item->chassis = $this->chassis;
            $item->cylinders = $this->cylinders;
            $item->notes = $this->notes;
            $item->customer_id = $this->customer;
            $item->car_brand_id = $this->brand;
            $item->car_model_id = $this->model;
            $item->registration_type_id = $this->type;
            $item->user_id = Auth::id();
            if ($this->attach != $item->attach) {
                if ($item->attach) {
                    unlink($item->attach);
                }
                $path = $this->attach->store('file', 'public');
                $item->attach = 'storage/'.$path;
            }
            if ($this->other != $item->other) {
                if ($item->other) {
                    unlink($item->other);
                }
                $path = $this->other->store('file', 'public');
                $item->other = 'storage/'.$path;
            }
            $item->save();
        }
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
        $this->carId = $id;
        $this->dispatchBrowserEvent('show-delete-model');
    }

    public function delete()
    {
        $item = Car::query()->findOrFail($this->carId);
        if ($item->attach) {
            unlink($item->attach);
        }
        if ($item->other) {
            unlink($item->other);
        }
        $item->delete();
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-delete-model');
        $this->carId = null;
        $this->reset();
    }
}
