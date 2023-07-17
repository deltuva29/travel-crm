<?php

namespace App\Nova;

use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;

class Slider extends Resource
{
    public static string $model = \App\Models\Slider::class;

    public static $title = 'title';

    public static function label(): string
    {
        return __('Slaideris');
    }

    public static function singularLabel(): string
    {
        return __('Slaideris');
    }

    public static $search = [
        'title',
    ];

    public function fields(Request $request): array
    {
        return [
            Text::make(__('Title'), 'title')
                ->sortable()
                ->rules('required', 'max:255'),

            Textarea::make(__('Aprašymas'), 'description')->rows(6),

            Text::make(__('Nuoroda'), 'link')
                ->rules('max:255'),

            Images::make(__('Nuotrauka'), 'background_image'),

            Boolean::make(__('Aktyvūs'), 'active')
                ->trueValue('1')
                ->falseValue('0'),
        ];
    }
}
