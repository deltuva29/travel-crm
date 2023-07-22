<?php

namespace App\Http\Traits\Customer;

use App\Models\Customer;

trait WithCustomer
{
    public Customer $user;

    public function mount(): void
    {
        $this->user = auth('customer')->user();
    }
}
