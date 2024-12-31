<?php

namespace App\Http\Livewire\JopCards;

use App\Models\JobCard;
use App\Traits\HasSettings;
use Livewire\Component;

class JopCardsPrint extends Component
{
    use HasSettings;
    public $car;
    public $job;

    public function mount($car, JobCard $job)
    {
        $this->car = $car;
        $this->job = $job;

    }

    public function render()
    {
        $settings = $this->getSettings();
        return view('livewire.jop-cards.jop-cards-print',[
            'settings' => $settings,
        ])
        ->extends('layouts.app')
        ->section('content');
    }
}
