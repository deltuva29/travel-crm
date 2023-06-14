<?php

namespace App\Nova\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class BusCrashFilter extends Filter
{
    public $component = 'select-filter';

    public function name(): string
    {
        return __('Būklė');
    }

    public function apply(Request $request, $query, $value): Builder
    {
        return $query->where('crash', $value);
    }

    public function options(Request $request): array
    {
        return [
            __('Papuolė į eismo įvykį') => 1,
            __('Nebuvo eismo įvykių') => 0
        ];
    }
}
