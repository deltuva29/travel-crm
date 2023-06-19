<?php

namespace App\Nova\Metrics\Customers;

use App\Models\Customer;
use Laravel\Nova\Metrics\Value;
use Laravel\Nova\Metrics\ValueResult;

class CountNewCustomers extends Value
{
    public function name(): string
    {
        return __('Nauji klientai');
    }

    public function calculate(): ValueResult
    {
        return $this->result(Customer::query()->whereDate('created_at', now()->today())->count());
    }

    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    public function uriKey(): string
    {
        return 'customers-count-new-customers';
    }
}
