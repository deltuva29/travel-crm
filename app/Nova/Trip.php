<?php

namespace App\Nova;

use App\Rules\AvailableBus;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Select;

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
                ->displayUsingLabels(),

            BelongsTo::make(__('Kelionės autobusas'), 'bus', Bus::class)
                ->rules('required', new AvailableBus())
                ->searchable()
                ->displayUsing(fn($value) => $value ? $value->getFullNameWithPlateNumberLabel() : '')
                ->help(__('Pasirinktas autobusas su kuriuo bus vykstama į kelionę.')),
        ];
    }
}
