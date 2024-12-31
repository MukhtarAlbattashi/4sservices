<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LoadingComponent extends Component
{
    public $wireTarget;

    public function __construct($wireTarget)
    {
        $this->wireTarget = $wireTarget;
    }

    public function render(): View|Closure|string
    {
        return view('components.loading-component');
    }
}
