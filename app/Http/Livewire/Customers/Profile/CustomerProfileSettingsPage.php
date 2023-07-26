<?php

namespace App\Http\Livewire\Customers\Profile;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CustomerProfileSettingsPage extends Component
{
    private function getHeadingTitle(): string
    {
        return __('Paskyros nustatymai');
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.customers.profile.customer-profile-settings-page', [
            'headingTitle' => $this->getHeadingTitle()
        ]);
    }
}
