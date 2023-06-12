<?php

namespace App\Nova\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class BusRepairFilter extends Filter
{
    public $component = 'select-filter';

    public function name(): string
    {
        return __('Remontas');
    }

    public function apply(Request $request, $query, $value): Builder
    {
        return $query->where('repair', $value);
    }

    public function options(Request $request): array
    {
        return [
            __('Remontuojamas') => 1,
            __('Nebuvo remontuojams') => 0
        ];
    }
}
