<?php

namespace App\Nova;

use App\Nova\Actions\Trips\CompleteTripAction;
use App\Nova\Actions\Trips\UpdateCompleteTripAction;
use App\Rules\AvailableBus;
use Illuminate\Http\Request;
use Laraning\NovaTimeField\TimeField;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Panel;
use NovaAttachMany\AttachMany;
use OptimistDigital\NovaSimpleRepeatable\SimpleRepeatable;

class Trip extends Resource
{
//    use Orderable;

    public static string $model = \App\Models\Trip::class;

    public static string $defaultOrderField = 'id';

    public function title(): string
    {
        return $this->getRouteFullName();
    }

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
                ->options(
                    \App\Models\Route::query()
                        ->orderBy('created_at', 'DESC')
                        ->get()
                        ->map(fn($route) => [
                            'value' => ($route->id ?? ''),
                            'label' => ($route->from ?? '').' - '.($route->to ?? ''),
                        ])
                        ->pluck('label', 'value')
                )
                ->creationRules('unique:trips,route_id')
                ->displayUsingLabels(),

            BelongsTo::make(__('Autobusas'), 'bus', Bus::class)
                ->rules('required', new AvailableBus())
                ->searchable()
                ->creationRules('unique:trips,bus_id')
                ->displayUsing(fn($value) => $value ? $value->getFullNameWithPlateNumberLabel() : '')
                ->help(__('Pasirinktas autobusas su kuriuo bus vykstama į kelionę.'))
                ->hideFromIndex(),

            BelongsTo::make(__('Paskirtas vairuotojas'), 'driver', User::class)
                ->rules('required')
                ->searchable()
                ->creationRules('unique:trips,driver_id')
                ->help(__('Įmonės vairuotojas su kuriuo bus vykstama į kelionę.'))
                ->hideFromIndex(),

            BelongsTo::make(__('Atsakingas darbuotojas'), 'employee', User::class)
                ->rules('required')
                ->searchable()
                ->creationRules('unique:trips,user_id')
                ->help(__('Pagalbinis darbuotojas su kuriuo bus vykstama į kelionę.')),

            new Panel(__('Datos'), $this->dateArrivedDepartureFields()),

            Textarea::make(__('Papildoma informacija'), 'note')->rows(6),

            new Panel(__('Atsiskaitymas'), $this->priceFields()),

            AttachMany::make(__('Įtraukti dalyviai'), 'participants', Customer::class)
                ->showCounts(),

            HasMany::make(__('Įtraukti dalyviai'), 'customers', TripCustomer::class),
        ];
    }

    protected function dateArrivedDepartureFields(): array
    {
        return [
            SimpleRepeatable::make('Data ir laikas', 'arrival_dates', [
                Date::make(__('Išvykimo data'), 'arrived_at')
                    ->rules('required', 'date_format:Y-m-d')
                    ->displayUsing(fn($date) => now()->parse($date)->format('Y-m-d'))
                    ->resolveUsing(fn($date) => $date),

                TimeField::make(__('Išvykimo laikas'), 'arrived_back_at')
                    ->rules('required', 'date_format:H:i')
                    ->displayUsing(fn($time) => now()->parse($time)->format('H:i'))
                    ->resolveUsing(fn($time) => $time),

                Date::make(__('Grįžimo data'), 'departure_at')
                    ->rules('required', 'date_format:Y-m-d')
                    ->displayUsing(fn($date) => now()->parse($date)->format('Y-m-d'))
                    ->resolveUsing(fn($date) => $date),

                TimeField::make(__('Grįžimo laikas'), 'departure_back_at')
                    ->rules('required', 'date_format:H:i')
                    ->displayUsing(fn($time) => now()->parse($time)->format('H:i'))
                    ->resolveUsing(fn($time) => $time),
            ])
                ->addRowLabel(__('Pridėti'))
                ->canAddRows(true)
                ->canDeleteRows(true),
        ];
    }

    protected function priceFields(): array
    {
        return [
            BelongsTo::make(__('Apmokėjimo būdas'), 'paymentMethod', PaymentMethod::class)
                ->rules('required')
                ->hideFromIndex(),

            Text::make(__('Žmonių skaičius'), function () {
                return '<span class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-primary mr-1">
                          <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM15.75 9.75a3 3 0 116 0 3 3 0 01-6 0zM2.25 9.75a3 3 0 116 0 3 3 0 01-6 0zM6.31 15.117A6.745 6.745 0 0112 12a6.745 6.745 0 016.709 7.498.75.75 0 01-.372.568A12.696 12.696 0 0112 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 01-.372-.568 6.787 6.787 0 011.019-4.38z" clip-rule="evenodd" />
                       <path d="M5.082 14.254a8.287 8.287 0 00-1.308 5.135 9.687 9.687 0 01-1.764-.44l-.115-.04a.563.563 0 01-.373-.487l-.01-.121a3.75 3.75 0 013.57-4.047zM20.226 19.389a8.287 8.287 0 00-1.308-5.135 3.75 3.75 0 013.57 4.047l-.01.121a.563.563 0 01-.373.486l-.115.04c-.567.2-1.156.349-1.764.441z" />
                  </svg> '.$this->getParticipantsInTripCount().'</span>
               ';
            })
                ->readonly()
                ->asHtml(),

            Text::make(__('Surinkta suma / Reikia surinkti sumą'), function () {
                $paidCustomers = $this->getPaidCustomersCountAndSumPrice();
                return <<<HTML
                    {$paidCustomers['sum']} surinkta iš {$paidCustomers['count']} žmonių / {$this->getRevenueOfParticipants()}
                  HTML;
            })
                ->readonly()
                ->hideFromIndex()
                ->asHtml(),

            Number::make(__('Kaina'), 'price')
                ->step(1.00)
                ->help(__('Nurodoma kaina į abi puses.'))
                ->resolveUsing(fn($value, $resource) => is_null($value) ? '0.00' : number_format($value, 2, '.', ''))
                ->displayUsing(fn($value, $resource) => $resource->formatPrice())
                ->asHtml(),

//            OrderField::make(__('Rikiavimas')),

            Text::make(__('Kelionės būsena'), fn() => $this->isAlreadyCompleted() ?
                '<span class="flex items-center text-md"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" aria-labelledby="check-circle" role="presentation" class="fill-current text-success mr-1"><path d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-2.3-8.7l1.3 1.29 3.3-3.3a1 1 0 0 1 1.4 1.42l-4 4a1 1 0 0 1-1.4 0l-2-2a1 1 0 0 1 1.4-1.42z"></path></svg> '.$this->getCompletedAtDateTime().'</span>'
                : '<span class="flex items-center text-md"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg> '.__('Važiuojama į '.$this->getSplitRouteName()).'</span>'
            )->asHtml(),
        ];
    }

    public function filters(Request $request): array
    {
        return [
            new Filters\Trips\ArrivedAtDateFilter(),
            new Filters\Trips\DepartureAtDateFilter(),
        ];
    }

    public function actions(Request $request): array
    {
        return [
            (new CompleteTripAction())
                ->confirmText(__('Ar tikrai norite užbaigti kelionę?'))
                ->confirmButtonText(__('Užbaigti'))
                ->cancelButtonText(_('Atšaukti')),
            (new UpdateCompleteTripAction())
                ->confirmText(__('Ar tikrai norite atnaujinti kelionę?'))
                ->confirmButtonText(__('Atnaujinti'))
                ->cancelButtonText(_('Atšaukti')),
        ];
    }
}
