<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CustomerSidebarTab extends Component
{
    public string $svg;
    public string $link;
    public string $label;
    public bool $isActive;

    public function __construct($svg, $link, $label, $isActive = false)
    {
        $this->svg = $svg;
        $this->link = $link;
        $this->label = $label;
        $this->isActive = $isActive;
    }

    public function render(): View|Factory|Htmlable|string|Closure|Application
    {
        return view('components.customer-sidebar-tab');
    }
}
