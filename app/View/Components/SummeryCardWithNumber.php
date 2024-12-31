<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SummeryCardWithNumber extends Component
{
    public function __construct(
        public $background,
        public $icon,
        public $title,
        public $number,
        public $route,
    ) {
    }

    public function render(): View
    {
        return view('components.summery-card-with-number');
    }
}
