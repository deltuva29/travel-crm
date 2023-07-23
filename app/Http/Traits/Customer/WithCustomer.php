<?php

namespace App\Http\Traits\Customer;

use App\Http\Traits\ContentLoader\WithContentLoader;
use App\Models\Customer;

trait WithCustomer
{
    use WithContentLoader;

    public ?Customer $customer = null;

    public function mount(): void
    {
        $this->initBackgroundLoader();
        $this->customer = auth('customer')->user();
    }
}
