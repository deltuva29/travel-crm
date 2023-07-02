<?php

namespace App\Nova;

use App\Rules\AvailableBus;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Panel;

class Trip extends Resource
{
    public static string $model = \App\Models\Trip::class;

    public static $title = 'from';

    public static function label(): string
    {
        return __('Kelionės');
    }

    public static function singularLabel(): string
    {
        return __('Kelionė');
    }

    public static $search = [
        'id',
    ];

    public function fields(Request $request): array
    {
        return [
            Select::make(__('Maršrutas'), 'route_id')
                ->rules('required')
                ->searchable()
                ->options(\App\Models\Route::query()
                    ->orderBy('created_at', 'DESC')
                    ->get()
                    ->map(fn($route) => [
                        'value' => ($route->id ?? ''),
                        'label' => ($route->from ?? '') . ' - ' . ($route->to ?? '')
                    ])
                    ->pluck('label', 'value')
                )
                ->creationRules('unique:trips,route_id')
                ->updateRules('unique:trips,route_id,{{resourceId}}')
                ->displayUsingLabels(),

            BelongsTo::make(__('Autobusas'), 'bus', Bus::class)
                ->rules('required', new AvailableBus())
                ->searchable()
                ->creationRules('unique:trips,bus_id')
                ->updateRules('unique:trips,bus_id,{{resourceId}}')
                ->displayUsing(fn($value) => $value ? $value->getFullNameWithPlateNumberLabel() : '')
                ->help(__('Pasirinktas autobusas su kuriuo bus vykstama į kelionę.'))
                ->hideFromIndex(),

            BelongsTo::make(__('Paskirtas vairuotojas'), 'driver', User::class)
                ->rules('required')
                ->searchable()
                ->creationRules('unique:trips,driver_id')
                ->updateRules('unique:trips,driver_id,{{resourceId}}')
                ->help(__('Įmonės vairuotojas su kuriuo bus vykstama į kelionę.'))
                ->hideFromIndex(),

            BelongsTo::make(__('Pagalbinis darbuotojas'), 'employee', User::class)
                ->rules('required')
                ->searchable()
                ->creationRules('unique:trips,user_id')
                ->updateRules('unique:trips,user_id,{{resourceId}}')
                ->help(__('Pagalbinis darbuotojas su kuriuo bus vykstama į kelionę.'))
                ->hideFromIndex(),

            new Panel(__('Data / Laikas'), $this->dateArrivedDepartureFields()),

            Textarea::make(__('Papildoma informacija'), 'note')->rows(6),

            new Panel(__('Atsiskaitymas'), $this->priceFields()),
        ];
    }

    protected function dateArrivedDepartureFields(): array
    {
        return [
            Date::make(__('Išvykimo data'), 'arrived_at')
                ->rules('required')
                ->firstDayOfWeek(1),

            Text::make(__('Išvykimo laikas'), 'arrived_back_at')
                ->placeholder('HH:mm')
                ->rules(['required', 'date_format:"H:i"'])
                ->help(__('Kelionės išvykimo laiko formatas: HH:mm'))
                ->resolveUsing(fn($value) => now()->parse($value)->format('H:i'))
                ->displayUsing(fn($value, $resource) => $resource->formatTime('arrived_back_at')),

            Date::make(__('Grįžimo data'), 'departure_at')
                ->rules('required')
                ->firstDayOfWeek(1),

            Text::make(__('Grįžimo laikas'), 'departure_back_at')
                ->placeholder('HH:mm')
                ->rules(['required', 'date_format:"H:i"'])
                ->help(__('Kelionės grįžimo laiko formatas: HH:mm'))
                ->resolveUsing(fn($value) => now()->parse($value)->format('H:i'))
                ->displayUsing(fn($value, $resource) => $resource->formatTime('departure_back_at')),
        ];
    }

    protected function priceFields(): array
    {
        return [
            BelongsTo::make(__('Apmokėjimo būdas'), 'paymentMethod', PaymentMethod::class)
                ->rules('required')
                ->hideFromIndex(),

            Number::make(__('Kaina'), 'price')
                ->step(1.00)
                ->help(__('Nurodoma kaina į abi puses.'))
                ->resolveUsing(fn($value, $resource) => is_null($value) ? '0.00' : number_format($value, 2, '.', ''))
                ->displayUsing(fn($value, $resource) => $resource->formatPrice())
                ->asHtml(),
        ];
    }
}
