<?php

namespace App\Http\Livewire\Customers\Profile;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CustomerProfileContactsPage extends Component
{
    private function getHeadingTitle(): string
    {
        $customer = auth('customer')->user();

        return $customer->isCompany() ? __('Kontaktinė įmonės informacija') : __('Kontaktinė informacija');
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.customers.profile.customer-profile-contacts-page', [
            'headingTitle' => $this->getHeadingTitle()
        ]);
    }
}
