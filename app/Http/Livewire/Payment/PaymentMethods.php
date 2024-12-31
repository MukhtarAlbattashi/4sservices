<?php

namespace App\Http\Livewire\Payment;

use App\Models\Payment;
use Livewire\Component;
use Livewire\WithPagination;

class PaymentMethods extends Component
{
    use WithPagination;

    public $arName;

    public $enName;

    public $search;

    public $paymentId;

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'arName' => 'required',
        'enName' => 'required',
    ];

    public function render()
    {
        return view('livewire.payment.payment-methods', [
            'cars' => Payment::query()->mySearch($this->search)->latest()->paginate(10),
        ]);
    }

    public function add(): void
    {
        $this->reset();
        $this->dispatchBrowserEvent('show-create-model');
    }

    public function update($id)
    {
        $this->paymentId = $id;
        $car = Payment::query()->findOrFail($this->paymentId);
        $this->arName = $car->arName;
        $this->enName = $car->enName;
        $this->dispatchBrowserEvent('show-edit-model');
    }

    public function updateCar()
    {
        $this->validate();
        $this->car(false, $this->paymentId);
        $this->notify('info', trans('public.update'));
        $this->dispatchBrowserEvent('hide-edit-model');
        $this->reset();
    }

    private function car(bool $new, $id)
    {
        $car = $new ? new Payment() : Payment::query()->findOrFail($id);
        $car->arName = $this->arName;
        $car->enName = $this->enName;
        $car->save();
    }

    public function save()
    {
        $this->validate();
        $this->car(true, null);
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-create-model');
        $this->reset();
    }

    public function remove($id)
    {
        $this->paymentId = $id;
        $this->dispatchBrowserEvent('show-delete-model');
    }

    public function delete()
    {
        Payment::query()->findOrFail($this->paymentId)->delete();
        $this->notify('success', trans('public.success'));
        $this->dispatchBrowserEvent('hide-delete-model');
        $this->paymentId = null;
        $this->reset();
    }
}
