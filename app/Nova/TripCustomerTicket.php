<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;

class TripCustomerTicket extends Resource
{
    public static string $model = \App\Models\TripCustomerTicket::class;

    public static function authorizedToCreate(Request $request): bool
    {
        return false;
    }

    public function authorizedToUpdate(Request $request): bool
    {
        return false;
    }

    public function authorizedToDelete(Request $request): bool
    {
        return false;
    }

    public static $title = 'code';

    public static function label(): string
    {
        return __('Pirkti bilietai');
    }

    public static function singularLabel(): string
    {
        return __('Pirktas bilietas');
    }

    public static array $searchRelations = [
        'customer' => ['first_name', 'last_name'],
    ];

    public static $search = [
        'id', 'code'
    ];

    public function fields(Request $request): array
    {
        return [
            Text::make(__('Bilieto.nr'), 'code')
                ->rules('required', 'max:255')
                ->sortable(),

            BelongsTo::make(__('Bilietą pirko'), 'customer', Customer::class)
                ->searchable(),

            Text::make(__('Bilietas galioja maršrutui'), function () {
                return $this->getTripRouteFullName() ?? '';
            })
                ->hideFromIndex()
                ->readonly()
                ->asHtml(),

            Number::make(__('Bilieto kaina'), 'price')
                ->sortable()
                ->step(1.00)
                ->help(__('Nurodoma kaina į abi puses.'))
                ->resolveUsing(fn($value, $resource) => is_null($value) ? '0.00' : number_format($value, 2, '.', ''))
                ->displayUsing(fn($value, $resource) => $resource->formatPrice())
                ->asHtml(),

            DateTime::make(__('Apmokėjimo data'), 'paid_at')
                ->hideFromIndex(),
        ];
    }

    public function cards(Request $request): array
    {
        return [
            new Metrics\CustomerTickets\CountTickets(),
            new Metrics\CustomerTickets\CountTicketEarnings(),
            new Metrics\CustomerTickets\CountTicketsPerDay(),
        ];
    }
}
