<?php

namespace App\Nova;

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
            Text::make(__('Iš'), 'from')
                ->sortable()
                ->rules('required', 'max:25'),

            Text::make(__('Į'), 'to')
                ->sortable()
                ->rules('required', 'max:25'),
        ];
    }
}
