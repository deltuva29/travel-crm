<?php

namespace App\Http\Livewire\Customers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CustomerDashboard extends Component
{
    public function render(): Factory|View|Application
    {
        return view('livewire.customers.customer-dashboard');
    }
}
