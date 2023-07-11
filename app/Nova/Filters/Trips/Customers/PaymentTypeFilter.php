<?php

namespace App\Nova\Filters\Trips\Customers;

use App\Enums\CustomerPaidType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class PaymentTypeFilter extends Filter
{
    public $component = 'select-filter';

    public function name(): string
    {
        return __('Apmokėjimo statusas');
    }

    public function apply(Request $request, $query, $value): Builder
    {
        return $query->where('paid_type', $value);
    }

    public function options(Request $request): array
    {
        return [
            __('Laukiama') => CustomerPaidType::PAYMENT_WAITING,
            __('Apmokėta') => CustomerPaidType::PAYMENT_SUCCESS,
            __('Atšaukta') => CustomerPaidType::PAYMENT_FAILED,
        ];
    }
}
