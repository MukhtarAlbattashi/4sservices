<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LinkCard extends Component
{
    public $backColor;
    public $title;
    public $subtitle;

    public function __construct($backColor, $title, $subtitle)
    {
        $this->backColor = $backColor;
        $this->title = $title;
        $this->subtitle = $subtitle;
    }
    public function render(): View
    {
        return view('components.link-card');
    }
}
