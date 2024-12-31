<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LinkComponent extends Component
{
    public $route;
    public $params;
    public $classes;
    public $icon;
    public $text;

    public function __construct($route, $params, $classes, $icon, $text)
    {
        $this->route = $route;
        $this->params = $params;
        $this->classes = $classes;
        $this->icon = $icon;
        $this->text = $text;
    }

    public function render()
    {
        return view('components.link-component');
    }
}
