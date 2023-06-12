<?php

namespace App\Nova\Filters;

use App\Models\BusType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use OptimistDigtal\NovaMultiselectFilter\MultiselectFilter;

class BusTypeFilter extends MultiselectFilter
{
    public function name(): string
    {
        return __('Tipas');
    }

    public function apply(Request $request, $query, $value): Builder
    {
        return $query->whereIn('type_id', $value);
    }

    public function options(Request $request): Collection
    {
        return BusType::all()->pluck('name', 'id');
    }
}
