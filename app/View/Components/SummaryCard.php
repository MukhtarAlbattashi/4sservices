<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SummaryCard extends Component
{
    public $backColor;
    public $color;
    public $title;
    public $subtitle;
    public $url;

    public function __construct($backColor, $color, $title, $subtitle, $url)
    {
        $this->backColor = $backColor;
        $this->color = $color;
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->url = $url;
    }

    public function render()
    {
        return view('components.summary-card');
    }
}
