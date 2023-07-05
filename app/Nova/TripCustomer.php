<?php

namespace App\Nova;

use App\Enums\CustomerType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class TripCustomer extends Resource
{
    public static string $model = \App\Models\Customer::class;

    public static $title = 'full_name';

    public static function label(): string
    {
        return __('Dalyviai');
    }

    public static function singularLabel(): string
    {
        return __('Naują dalyvį');
    }

    public static $search = [
        'id', 'full_name',
    ];

    public static function indexQuery(NovaRequest $request, $query): Builder
    {
        $query = parent::indexQuery($request, $query);
        $query->where('type', CustomerType::PASSENGER);

        return $query;
    }

    public function fields(Request $request): array
    {
        return [
            Text::make(__('Dalyvis'), function () {
                return $this->fullName ?? '';
            })
                ->hideFromDetail()
                ->readonly()
                ->asHtml(),

            Text::make(__('Kaina'), function () {
                return $this->getPriceOfTripCustomer() ?? '';
            })
                ->readonly()
                ->asHtml(),
        ];
    }
}
