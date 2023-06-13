<?php

namespace App\Nova;

use Benjacho\BelongsToManyField\BelongsToManyField;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Panel;
use Naif\Toggle\Toggle;
use NrmlCo\NovaBigFilter\NovaBigFilter;

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
        'id', 'brand', 'model', 'plate_number',
    ];

    public function fields(Request $request): array
    {
        return [
            Images::make(__('Pagrindinė nuotrauka'), 'main_image'),

            Images::make(__('Daugiau kitokių nuotraukų'), 'additional_images')->hideFromIndex(),

            Text::make(__('Pavadinimas'), 'brand')
                ->rules('required', 'max:255')
                ->sortable(),

            Text::make(__('Modelis'), 'model')
                ->rules('required', 'max:30')
                ->sortable(),

            BelongsToManyField::make(__('Kokie privalumai yra viduje'), 'features', BusFeature::class)
                ->help(__('Pasirinkite pagrindinius privalumus autobuso viduje.'))
                ->optionsLabel('name')
                ->showAsListInDetail()
                ->onlyOnDetail()
                ->showOnCreating()
                ->showOnUpdating(),

            Textarea::make(__('Papildoma informacija'), 'note')->rows(6),

            BelongsTo::make(__('Paskirtas vairuotojas'), 'user', User::class)
                ->searchable(),

            Text::make(__('Valst.nr'), function () {
                return '<h4>' . $this->plate_number . '</h4>';
            })
                ->onlyOnDetail()
                ->readonly()
                ->asHtml(),

            Text::make(__('Valst.nr'), 'plate_number')
                ->rules('required', 'max:30')
                ->sortable()
                ->hideFromDetail()
                ->showOnCreating()
                ->showOnUpdating(),

            new Panel(__('Specifikacijos'), $this->additionalFields()),

            BelongsTo::make(__('Tipas'), 'type', BusType::class),

            new Panel(__('Būklė'), $this->technicalFields()),

            HasMany::make(__('Tipas'), 'types', BusType::class),

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
            Heading::make('V - Važiuojantis / R - Remontuojamas / C - Daužtas, pateko į eismo įvykį'),
            Toggle::make(__('V'), 'active')
                ->showOnIndex()
                ->offColor('#d9cdcb')
                ->onColor('61b30a'),

            Toggle::make(__('R'), 'repair')
                ->showOnIndex()
                ->offColor('#d9cdcb')
                ->onColor('61b30a'),

            Toggle::make(__('C'), 'crash')
                ->showOnIndex()
                ->offColor('#d9cdcb')
                ->onColor('61b30a'),
        ];
    }

    public function filters(Request $request): array
    {
        return [
            new Filters\BusSeatsFilter(),
            new Filters\BusFuelPer100kmFilter(),
            new Filters\BusFuelInLitresFilter(),
            new Filters\BusFeaturesFilter(),
            new Filters\BusTypeFilter(),
            new Filters\User\RoleDriverFilter(),
            new Filters\BusActiveFilter(),
            new Filters\BusRepairFilter(),
            new Filters\BusCrashFilter(),
        ];
    }

    public function cards(Request $request): array
    {
        return [
            (new NovaBigFilter)->setTitle('Filtravimas'),
        ];
    }
}
