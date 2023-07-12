<?php

namespace App\Nova;

use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;

class Route extends Resource
{
    public static string $model = \App\Models\Route::class;

    public static $title = 'name';

    public static function label(): string
    {
        return __('Maršrutai');
    }

    public static function singularLabel(): string
    {
        return __('Maršrutas');
    }

    public function fields(Request $request): array
    {
        return [
            Images::make(__('Pagrindinė nuotrauka'), 'main_image'),

            Images::make(__('Daugiau kitokių nuotraukų'), 'additional_images')->hideFromIndex(),

            Text::make(__('Išvykimo vieta'), 'from')
                ->sortable()
                ->rules('required', 'max:25')
                ->help(__('Iš kurio miesto/šalies')),

            Text::make(__('Atvykimo vieta'), 'to')
                ->sortable()
                ->rules('required', 'max:25')
                ->help(__('Į kurį miestą/šalį')),
        ];
    }
}
