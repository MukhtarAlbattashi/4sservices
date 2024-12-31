<?php

namespace App\Http\Livewire\JopCards;

use App\Models\JobCard;
use Livewire\Component;

class JopCardViewPage extends Component
{

    public $car;
    public $job;

    public function mount($car, JobCard $job)
    {
        $this->car = $car;
        $this->job = $job;
        //dd($job);
    }
    public function render()
    {
        return view('livewire.jop-cards.jop-card-view-page');
    }
}