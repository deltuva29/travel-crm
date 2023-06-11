<?php

namespace App\Nova\Filters;

use App\Models\Bus;
use Illuminate\Http\Request;
use Oleksiypetlyuk\NovaRangeFilter\NovaRangeFilter;

class BusFuelInLitresFilter extends NovaRangeFilter
{
    public $name = 'Bakas';

    public function __construct()
    {
        $this->min = $this->getMinFuelInLitres();
        $this->max = $this->getMaxFuelInLitres();

        parent::__construct();
    }

    protected function getMinFuelInLitres(): int
    {
        return Bus::min('fuel_in_litres') ?? 0;
    }

    protected function getMaxFuelInLitres(): int
    {
        return Bus::max('fuel_in_litres') ?? 0;
    }

    public function apply(Request $request, $query, $value)
    {
        if (count($value) > 0) {
            return $query->when($value, fn($query) => $query->whereBetween('fuel_in_litres', $value))
                ->orWhereNull('fuel_in_litres');
        }
    }
}
