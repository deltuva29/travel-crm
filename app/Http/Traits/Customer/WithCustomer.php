<?php

namespace App\Http\Traits\Customer;

use App\Models\Customer;

trait WithCustomer
{
    public ?Customer $customer = null;

    public function mount(): void
    {
        $this->customer = auth('customer')->user();
    }
}
