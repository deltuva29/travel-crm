<?php

namespace App\Http\Livewire\Sliders;

use App\Models\Slider as Carousel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;

class Slider extends Component
{
    protected $slider;

    public function getCarouselProperty(): Collection|array
    {
        $this->slider = Carousel::query()
            ->where('active', 1)
            ->orderBy('created_at')
            ->get();

        return $this->slider;
    }

    public function getCarousel(): Collection|array
    {
        return $this->getCarouselProperty();
    }

    public function render(): Factory|View|Application
    {
        $carousels = $this->getCarousel();

        return view('livewire.sliders.slider', [
            'carousels' => $carousels,
        ]);
    }
}
