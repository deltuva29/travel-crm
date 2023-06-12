<?php

namespace App\Nova\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class BusActiveFilter extends Filter
{
    public $component = 'select-filter';

    public function name(): string
    {
        return __('Statusas');
    }

    public function apply(Request $request, $query, $value): Builder
    {
        return $query->where('active', $value);
    }

    public function options(Request $request): array
    {
        return [
            __('Važiuojantis') => 1,
            __('Nevažiuojantis') => 0
        ];
    }
}
