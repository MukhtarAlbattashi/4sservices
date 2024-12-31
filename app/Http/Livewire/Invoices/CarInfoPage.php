<?php

namespace App\Http\Livewire\Invoices;

use App\Models\Car;
use Livewire\Component;

class CarInfoPage extends Component
{

    public $car;
    public function mount(Car $car)
    {
        $this->car = $car;
    }

    public function render()
    {
        return view('livewire.invoices.car-info-page');
    }
}
