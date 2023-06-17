<?php

namespace App\Nova\Filters\Customers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\BooleanFilter;

class CustomerStatusFilter extends BooleanFilter
{
    public function name(): string
    {
        return __('Kliento statusas');
    }

    public function apply(Request $request, $query, $value): Builder
    {
        if (!empty($value === '0')) {
            return $query->where('status', $value['active']);
        }
        return $query->where('status', !$value['active']);
    }

    public function options(Request $request): array
    {
        return [
            __('Neaktyvuoti klientai') => 'active',
        ];
    }
}
