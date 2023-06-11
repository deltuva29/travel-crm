<?php

namespace App\Nova;

use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Heading;
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

            Heading::make(__('Svarbi informacija')),

            BelongsTo::make(__('Paskirtas vairuotojas'), 'user', User::class)
                ->searchable(),

            Text::make(__('Valstybinis numeris'), 'plate_number')
                ->rules('required', 'max:30')
                ->sortable()
                ->onlyOnDetail()
                ->showOnCreating()
                ->showOnUpdating(),

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
                ->sortable()
                ->onlyOnDetail()
                ->showOnCreating()
                ->showOnUpdating(),

            Text::make(__('Vietos'), 'seats')
                ->rules('required', 'max:15')
                ->sortable()
                ->onlyOnDetail()
                ->showOnCreating()
                ->showOnUpdating(),

            Text::make(__('Visos vietos'), 'seats_max')
                ->rules('required', 'max:15')
                ->sortable()
                ->onlyOnDetail()
                ->showOnCreating()
                ->showOnUpdating(),

            Text::make(__('Bakas'), 'fuel_in_litres')
                ->rules('required', 'max:15')
                ->sortable()
                ->onlyOnDetail()
                ->showOnCreating()
                ->showOnUpdating(),
        ];
    }

    protected function technicalFields(): array
    {
        return [
            Boolean::make(__('Važiuojantis'), 'active')
                ->sortable()
                ->help(__('Pažymėkite jei autobusas yra tvarkingas ir važiuojantis.'))
                ->showOnIndex(),

            Boolean::make(__('Remontuojamas'), 'repair')
                ->sortable()
                ->help(__('Pažymėkite jei autobusas yra šiuo metu remonte.'))
                ->onlyOnDetail()
                ->showOnCreating()
                ->showOnUpdating(),

            Boolean::make(__('Po avarijos/nelaimės'), 'crash')
                ->sortable()
                ->help(__('Pažymėkite jei autobusas buvo papuoles nesenai į eismo įvykį.'))
                ->onlyOnDetail()
                ->showOnCreating()
                ->showOnUpdating(),
        ];
    }
}
