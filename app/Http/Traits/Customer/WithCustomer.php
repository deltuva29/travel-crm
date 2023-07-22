<?php

namespace App\Http\Traits\Customer;

use App\Models\Customer;

trait WithCustomer
{
    public Customer $customer;

    public function mount(): void
    {
        $this->customer = auth('customer')->user();
    }
}
