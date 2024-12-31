<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ButtonComponent extends Component
{
    public $wireClick;
    public $classes;
    public $icon;
    public $text;
    public $dataBsToggle;
    public $dataBsTarget;

    public function __construct($wireClick, $classes, $icon, $text, $dataBsToggle = null, $dataBsTarget = null)
    {
        $this->wireClick = $wireClick;
        $this->classes = $classes;
        $this->icon = $icon;
        $this->text = $text;
        $this->dataBsToggle = $dataBsToggle;
        $this->dataBsTarget = $dataBsTarget;
    }
    public function render(): View|Closure|string
    {
        return view('components.button-component');
    }
}
