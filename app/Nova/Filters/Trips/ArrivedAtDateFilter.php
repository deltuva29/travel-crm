<?php

namespace App\Nova\Filters\Trips;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\DateFilter;

class ArrivedAtDateFilter extends DateFilter
{
    public function name(): string
    {
        return __('Išvykimo data');
    }

    public function apply(Request $request, $query, $value): Builder
    {
        return $query->where(fn($query) => $query->whereJsonContains('arrival_dates', [
            ['arrived_at' => $value]
        ]));
    }
}
