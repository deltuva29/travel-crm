<?php

namespace App\Nova\Filters\Customer;

use App\Enums\CustomerType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class ClientTypeFilter extends Filter
{
    public $component = 'select-filter';

    public function name(): string
    {
        return __('Kliento tipas');
    }

    public function apply(Request $request, $query, $value): Builder
    {
        return $query->where('type', $value);
    }

    public function options(Request $request): array
    {
        return [
            __('Nuomotojai') => CustomerType::RENTER,
            __('Keleiviai') => CustomerType::COMPANY,
            __('Įmonės') => CustomerType::COMPANY,
        ];
    }
}
