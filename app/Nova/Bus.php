<?php

namespace App\Nova;

use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Panel;

class Bus extends Resource
{
    public static string $model = \App\Models\Bus::class;

    public static $title = 'brand';

    public static function label(): string
    {
        return __('Autobusai');
    }

    public static function singularLabel(): string
    {
        return __('Autobusas');
    }

    public static $search = [
        'id',
    ];

    public function fields(Request $request): array
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            Text::make(__('Pavadinimas'), 'brand')
                ->rules('required', 'max:255')
                ->sortable(),

            Text::make(__('Modelis'), 'model')
                ->rules('required', 'max:30')
                ->sortable(),

            Images::make(__('Pagrindinė nuotrauka'), 'main_image'),

            Images::make(__('Daugiau kitokių nuotraukų'), 'additional_images')->hideFromIndex(),

            BelongsTo::make(__('Paskirtas vairuotojas'), 'user', User::class)
                ->searchable(),

            new Panel(__('Privalumai'), $this->additionalFields()),

            new Panel(__('Būklė'), $this->technicalFields()),

            BelongsToMany::make(__('Prisegti autobuso privalumai'), 'features', BusFeature::class)
        ];
    }

    protected function additionalFields(): array
    {
        return [
            Text::make(__('Kuro sąnaudos ~ 100km'), 'fuel_per_100_km')
                ->rules('required', 'max:15')
                ->sortable(),

            Text::make(__('Vietos'), 'seats')
                ->rules('required', 'max:15')
                ->sortable(),

            Text::make(__('Bakas'), 'fuel_in_litres')
                ->rules('required', 'max:15')
                ->sortable(),
        ];
    }

    protected function technicalFields(): array
    {
        return [
            Boolean::make(__('Šiuo metu eksplotuojamas(važiuojantis)'), 'active')
                ->sortable()->help(__('Pažymėkite jei autobusas yra tvarkingas ir važiuojantis.')),

            Boolean::make(__('Remontuojamas'), 'repair')
                ->sortable()->help(__('Pažymėkite jei autobusas yra šiuo metu remonte.')),

            Boolean::make(__('Po avarijos/nelaimės'), 'crash')
                ->sortable()->help(__('Pažymėkite jei autobusas buvo papuoles nesenai į eismo įvykį.')),
        ];
    }
}
