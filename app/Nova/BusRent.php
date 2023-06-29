<?php

namespace App\Nova;

use App\Enums\LocationOfRentType;
use App\Enums\RentType;
use App\Rules\AvailableBus;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;

class BusRent extends Resource
{
    public static string $model = \App\Models\BusRent::class;

    public static $title = 'id';

    public static function label(): string
    {
        return __('Sąrašas nuomojamų autobusų');
    }

    public static function singularLabel(): string
    {
        return __('Autobusas nuomai');
    }

    public static $search = [
        'id',
    ];

    public function fields(Request $request): array
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            BelongsTo::make(__('Klientas'), 'customer', Customer::class)
                ->searchable(),

            BelongsTo::make(__('Autobusas'), 'bus', Bus::class)
                ->rules('required', new AvailableBus())
                ->searchable(),

            BelongsTo::make(__('Paskirtas vairuotojas'), 'driver', User::class)
                ->searchable(),

            Text::make(__('Nuomos tipas'), function () {
                return isset($this->type) ? RentType::labels()[$this->type] : null;
            })
                ->exceptOnForms()
                ->hideFromIndex(),

            Select::make(__('Nuomos tipas'), 'type')
                ->rules('required')
                ->options(RentType::labels())
                ->onlyOnForms(),

            Text::make(__('Nuomos vieta'), function () {
                return isset($this->location) ? LocationOfRentType::labels()[$this->location] : null;
            })
                ->exceptOnForms()
                ->hideFromIndex(),

            Select::make(__('Nuomos vieta'), 'location')
                ->rules('required')
                ->options(LocationOfRentType::labels())
                ->onlyOnForms(),

            DateTime::make(__('Nuomos pradžios data'), 'start_time')
                ->rules('required')
                ->firstDayOfWeek(1)
                ->sortable(),

            DateTime::make(__('Nuomos pabaigos data'), 'end_time')
                ->rules('required')
                ->firstDayOfWeek(1)
                ->sortable(),
        ];
    }
}
