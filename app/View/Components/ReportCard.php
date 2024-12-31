<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ReportCard extends Component
{
    public $backColor;
    public $color;
    public $title;
    public $subtitle;

    public function __construct($backColor, $color, $title, $subtitle)
    {
        $this->backColor = $backColor;
        $this->color = $color;
        $this->title = $title;
        $this->subtitle = $subtitle;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.report-card');
    }
}
