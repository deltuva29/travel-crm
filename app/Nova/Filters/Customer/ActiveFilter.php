<?php

namespace App\Nova\Filters\Customer;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\BooleanFilter;

class ActiveFilter extends BooleanFilter
{
    public function name(): string
    {
        return __('Kliento statusas');
    }

    public function apply(Request $request, $query, $value): Builder
    {
        if (!empty($value === '0')) {
            return $query->where('active', $value['active']);
        }
        return $query->where('active', !$value['active']);
    }

    public function options(Request $request): array
    {
        return [
            __('Neaktyvuoti klientai') => 'active',
        ];
    }
}
