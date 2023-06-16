<?php

namespace App\Nova;

use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Naif\Toggle\Toggle;

class Customer extends Resource
{
    public static string $model = \App\Models\Customer::class;

    public static $title = 'full_name';

    public static function label(): string
    {
        return __('Klientai');
    }

    public static function singularLabel(): string
    {
        return __('Klientas');
    }

    public static $search = [
        'id', 'first_name', 'last_name', 'email'
    ];

    public function fields(Request $request): array
    {
        return [
            Images::make(__('Nuotrauka'), 'avatar'),

            Text::make(__('Vardas'), 'first_name')
                ->rules('required', 'max:255')
                ->sortable(),

            Text::make(__('Pavardė'), 'last_name')
                ->rules('required', 'max:255')
                ->sortable(),

            Text::make(__('El.paštas'), 'email')
                ->rules('required', 'max:255', 'email')
                ->sortable(),

            Text::make(__('Telefono numeris'), 'phone')
                ->rules('required', 'max:15')
                ->sortable(),

            Text::make(__('Adresas'), 'address')
                ->hideFromIndex()
                ->rules('required', 'max:255'),

            Toggle::make(__('Aktyvus'), 'active')
                ->offColor('#d9cdcb')
                ->onColor('61b30a'),
        ];
    }
}
