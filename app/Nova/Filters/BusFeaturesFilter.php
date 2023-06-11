<?php

namespace App\Nova\Filters;

use App\Models\BusFeature;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\BooleanFilter;

class BusFeaturesFilter extends BooleanFilter
{
    public function name(): string
    {
        return __('Privalumai');
    }

    public function apply(Request $request, $query, $value): Builder
    {
        if (count($value) > 0) {
            $idsOfFeaturesValues = collect($value)
                ->filter(fn($val) => $val)
                ->keys()
                ->toArray();

            if (count($idsOfFeaturesValues) > 0) {
                return $query->withWhereHas('features', fn($query) => $query->whereIn('bus_feature_id', $idsOfFeaturesValues));
            }
        }

        return $query;
    }

    public function options(Request $request): callable|array
    {
        return BusFeature::getArrayOfAllFeaturesForFilters();
    }
}
