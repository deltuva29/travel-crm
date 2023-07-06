<?php

namespace App\Nova;

use App\Enums\CustomerType;
use App\Nova\Actions\Trips\CompleteTripAction;
use App\Nova\Actions\Trips\UpdateCompleteTripAction;
use App\Rules\AvailableBus;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Illuminate\Http\Request;
use Laraning\NovaTimeField\TimeField;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Panel;
use NovaAttachMany\AttachMany;

class Trip extends Resource
{
    public static string $model = \App\Models\Trip::class;

    public static $title = 'from';

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
        $customersWithParticipants = \App\Models\Customer::query()
            ->where('type', CustomerType::PARTICIPANT)
            ->whereDoesntHave('participants')
            ->get();

        return [
            Images::make(__('Pagrindinė nuotrauka'), 'main_image')->hideFromIndex(),

            Images::make(__('Daugiau kitokių nuotraukų'), 'additional_images')->hideFromIndex(),

            Select::make(__('Maršrutas'), 'route_id')
                ->rules('required')
                ->searchable()
                ->options(\App\Models\Route::query()
                    ->orderBy('created_at', 'DESC')
                    ->get()
                    ->map(fn($route) => [
                        'value' => ($route->id ?? ''),
                        'label' => ($route->from ?? '') . ' - ' . ($route->to ?? '')
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

            BelongsTo::make(__('Pagalbinis darbuotojas'), 'employee', User::class)
                ->rules('required')
                ->searchable()
                ->creationRules('unique:trips,user_id')
                ->help(__('Pagalbinis darbuotojas su kuriuo bus vykstama į kelionę.'))
                ->hideFromIndex(),

            new Panel(__('Data / Laikas'), $this->dateArrivedDepartureFields()),

            Textarea::make(__('Papildoma informacija'), 'note')->rows(6),

            new Panel(__('Atsiskaitymas'), $this->priceFields()),

            AttachMany::make(__('Įtraukti dalyviai'), 'participants', TripCustomer::class)
                ->showCounts()
                ->showPreview(),

            BelongsToMany::make(__('Įtraukti dalyviai'), 'participants', TripCustomer::class),
        ];
    }

    protected function dateArrivedDepartureFields(): array
    {
        return [
            Date::make(__('Išvykimo data'), 'arrived_at')
                ->rules('required')
                ->firstDayOfWeek(1),

            TimeField::make(__('Išvykimo laikas'), 'arrived_back_at'),

            Date::make(__('Grįžimo data'), 'departure_at')
                ->rules('required')
                ->firstDayOfWeek(1),

            TimeField::make(__('Grįžimo laikas'), 'departure_back_at'),
        ];
    }

    protected function priceFields(): array
    {
        return [
            BelongsTo::make(__('Apmokėjimo būdas'), 'paymentMethod', PaymentMethod::class)
                ->rules('required')
                ->hideFromIndex(),

            Number::make(__('Kaina'), 'price')
                ->step(1.00)
                ->help(__('Nurodoma kaina į abi puses.'))
                ->resolveUsing(fn($value, $resource) => is_null($value) ? '0.00' : number_format($value, 2, '.', ''))
                ->displayUsing(fn($value, $resource) => $resource->formatPrice())
                ->asHtml(),

            Text::make(__(''), fn() => $this->isAlreadyCompleted() ?
                '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" aria-labelledby="check-circle" role="presentation" class="fill-current text-success"><path d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-2.3-8.7l1.3 1.29 3.3-3.3a1 1 0 0 1 1.4 1.42l-4 4a1 1 0 0 1-1.4 0l-2-2a1 1 0 0 1 1.4-1.42z"></path></svg>'
                : '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-warning">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>'
            )->asHtml(),
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
