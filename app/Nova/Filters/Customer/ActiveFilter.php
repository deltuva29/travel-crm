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
        if (!$value['not-active']) {
            return $query->where('active', !$value['not-active']);
        }
        return $query;
    }

    public function options(Request $request): array
    {
        return [
            __('Neaktyvuoti klientai') => 'not-active',
            __('Visi klientai') => 'all',
        ];
    }
}
