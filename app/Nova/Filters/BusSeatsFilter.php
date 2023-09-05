<?php

namespace App\Nova\Filters;

use App\Models\Bus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Oleksiypetlyuk\NovaRangeFilter\NovaRangeFilter;

class BusSeatsFilter extends NovaRangeFilter
{
    public $name = 'Vietų skaičius';

    public function __construct()
    {
        $this->min = $this->getMinSeats();
        $this->max = $this->getMaxSeats();

        parent::__construct();
    }

    protected function getMinSeats(): int
    {
        return Bus::query()->min('seats') ?? 0;
    }

    protected function getMaxSeats(): int
    {
        return Bus::query()->max('seats') ?? 0;
    }

    public function apply(Request $request, $query, $value): Builder
    {
        if (count($value) > 0) {
            return $query->when($value > 0, fn($query) => $query->whereBetween('seats', $value))
                ->orWhereNull('seats');
        }
        return $query;
    }
}

