<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Text;

class PaymentMethod extends Resource
{
    public static string $model = \App\Models\PaymentMethod::class;

    public static $title = 'name';

    public static function label(): string
    {
        return __('Apmokėjimo būdai');
    }

    public static function singularLabel(): string
    {
        return __('Apmokėjimo būdas');
    }

    public static $search = [
        'id', 'name'
    ];

    public function fields(Request $request): array
    {
        return [
            Text::make(__('Pavadinimas'), 'name')
                ->rules('required', 'max:255')
                ->sortable(),

            Boolean::make(__('Aktyvus'), 'active'),
        ];
    }
}
