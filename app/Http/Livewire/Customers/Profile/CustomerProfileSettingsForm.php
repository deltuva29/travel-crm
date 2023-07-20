<?php

namespace App\Http\Livewire\Customers\Profile;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CustomerProfileSettingsForm extends Component
{
    public $isLoading = false;

    protected $listeners = [
        'loaded' => 'doLoading'
    ];

    public function doLoading(): void
    {
        $this->isLoading = true;
        $this->dispatchBrowserEvent('start-loading');
        $this->emit('loaded');
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.customers.profile.customer-profile-settings-form');
    }
}
