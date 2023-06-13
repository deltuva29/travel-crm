<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Naif\Toggle\Toggle;

class BusFeature extends Resource
{
    public static string $model = \App\Models\BusFeature::class;

    public static $title = 'name';

    public static function label(): string
    {
        return __('Autobusų privalumai');
    }

    public static function singularLabel(): string
    {
        return __('Autobuso privalumas');
    }

    public static $search = [
        'name',
    ];

    public function fields(Request $request): array
    {
        return [
            Text::make(__('Pavadinimas'), 'name')
                ->rules('required', 'max:255')
                ->sortable(),

            Toggle::make(__('Aktyvus'), 'active')
                ->showOnIndex()
                ->offColor('#d9cdcb')
                ->onColor('61b30a'),
        ];
    }
}
