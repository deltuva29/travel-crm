<?php

namespace App\Http\Livewire\Customers\Profile;

use App\Http\Traits\Customer\WithCustomer;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CustomerProfilePage extends Component
{
    use WithCustomer;

    public function render(): Factory|View|Application
    {
        return view('livewire.customers.profile.customer-profile-page');
    }
}
