<?php

namespace App\Nova\Filters;

use App\Models\Bus;
use Illuminate\Http\Request;
use Oleksiypetlyuk\NovaRangeFilter\NovaRangeFilter;

class BusFuelPer100kmFilter extends NovaRangeFilter
{
    public $name = 'Kuro sąnaudos ~ 100km';

    public function __construct()
    {
        $this->min = $this->getMinFuelPer();
        $this->max = $this->getMaxFuelPer();

        parent::__construct();
    }

    protected function getMinFuelPer(): int
    {
        return Bus::min('fuel_per_100_km') ?? 0;
    }

    protected function getMaxFuelPer(): int
    {
        return Bus::max('fuel_per_100_km') ?? 0;
    }

    public function apply(Request $request, $query, $value)
    {
        if (count($value) > 0) {
            return $query->when($value, fn($query) => $query->whereBetween('fuel_per_100_km', $value))
                ->orWhereNull('fuel_per_100_km');
        }
    }
}
