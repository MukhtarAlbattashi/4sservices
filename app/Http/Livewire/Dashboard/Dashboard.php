<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

class Dashboard extends Component
{
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.dashboard.dashboard');
    }
}
