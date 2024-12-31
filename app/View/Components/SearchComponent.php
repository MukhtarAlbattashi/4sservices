<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SearchComponent extends Component
{
    public $wireModel;

    public function __construct($wireModel)
    {
        $this->wireModel = $wireModel;
    }

    public function render(): View|Closure|string
    {
        return view('components.search-component');
    }
}
