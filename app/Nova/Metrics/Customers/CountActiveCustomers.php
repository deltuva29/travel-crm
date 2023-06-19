<?php

namespace App\Nova\Metrics\Customers;

use App\Models\Customer;
use Laravel\Nova\Metrics\Value;
use Laravel\Nova\Metrics\ValueResult;

class CountActiveCustomers extends Value
{
    public function name(): string
    {
        return __('Aktyvuoti klientai');
    }

    public function calculate(): ValueResult
    {
        return $this->result(Customer::query()->where('status', true)->count());
    }

    public function cacheFor()
    {
        //return now()->addMinutes(5);
    }

    public function uriKey(): string
    {
        return 'customers-count-active-customers';
    }
}
