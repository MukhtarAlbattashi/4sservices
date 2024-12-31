<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextWithBackground extends Component
{
    public function __construct(
        public $number,
        public $state,
    ) {
    }

    public function render(): View
    {
        return view('components.text-with-background');
    }
}
