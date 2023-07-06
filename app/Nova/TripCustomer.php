<?php

namespace App\Nova;

use App\Enums\CustomerType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Isseta\CustomStatusBadge\CustomStatusBadge;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class TripCustomer extends Resource
{
    public static string $model = \App\Models\Customer::class;

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

    public static $title = 'full_name';

    public static function label(): string
    {
        return __('Dalyviai');
    }

    public static function singularLabel(): string
    {
        return __('Naują dalyvį');
    }

    public static $search = [
        'id', 'full_name',
    ];

    public static function indexQuery(NovaRequest $request, $query): Builder
    {
        $query = parent::indexQuery($request, $query);
        $query->where('type', CustomerType::PARTICIPANT);

        return $query;
    }

    public function fields(Request $request): array
    {
        return [
            Text::make(__('Dalyvis'), function () {
                return $this->fullName ?? '';
            })
                ->hideFromDetail()
                ->readonly()
                ->asHtml(),

            Text::make(__('Komentaras'), function () {
                return $this->tripCustomer?->trip?->note ?? '';
            })
                ->hideFromIndex()
                ->readonly()
                ->asHtml(),

            Text::make(__('Skambutis'), function () {
                return $this->tripCustomer?->need_call
                    ? '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-primary">
                          <path fill-rule="evenodd" d="M1.5 4.5a3 3 0 013-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 01-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 006.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 011.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 01-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5z" clip-rule="evenodd" />
                        </svg>
                    '
                    : '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-danger">
                          <path fill-rule="evenodd" d="M15.22 3.22a.75.75 0 011.06 0L18 4.94l1.72-1.72a.75.75 0 111.06 1.06L19.06 6l1.72 1.72a.75.75 0 01-1.06 1.06L18 7.06l-1.72 1.72a.75.75 0 11-1.06-1.06L16.94 6l-1.72-1.72a.75.75 0 010-1.06zM1.5 4.5a3 3 0 013-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 01-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 006.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 011.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 01-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5z" clip-rule="evenodd" />
                        </svg>
                    ';
            })
                ->hideFromIndex()
                ->readonly()
                ->asHtml(),

            Text::make(__('Kaina'), function () {
                return $this->getPriceOfTripCustomer() ?? '';
            })
                ->readonly()
                ->asHtml(),

            CustomStatusBadge::make(__('Apmokėjimo statusas'), 'paid_type')
                ->withMeta([
                    'paidType' => $this->tripCustomer?->paid_type ?? '',
                ]),
        ];
    }
}
