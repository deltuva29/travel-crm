<?php

namespace App\Nova;

use App\Nova\Actions\Trips\Customers\PaymentTicketAction;
use App\Nova\Actions\Trips\Customers\PaymentTicketCanceledAction;
use Illuminate\Http\Request;
use Isseta\CustomStatusBadge\CustomStatusBadge;
use Laravel\Nova\Fields\Text;

class TripCustomer extends Resource
{
    public static string $model = \App\Models\TripCustomer::class;

    public static function authorizedToCreate(Request $request): bool
    {
        return false;
    }

    public function authorizedToDelete(Request $request): bool
    {
        return false;
    }

    public function title(): string
    {
        return $this->getCustomerFullName();
    }

    public static function label(): string
    {
        return __('Kelionės dalyviai');
    }

    public static function singularLabel(): string
    {
        return __('Kelionės dalyvis');
    }

    public static array $searchRelations = [
        'customer' => ['first_name', 'last_name'],
    ];

    public static $search = [
        'id',
    ];

    public function fields(Request $request): array
    {
        return [
            Text::make(__('Dalyvis'), function () {
                return $this->getCustomerFullName() ?? '';
            })
                ->hideFromDetail()
                ->readonly()
                ->asHtml(),

            Text::make(__('Komentaras'), function () {
                return $this->getNoteLikeComment() ?? '';
            })
                ->hideFromIndex()
                ->readonly()
                ->asHtml(),

            Text::make(__('Skambutis'), function () {
                return $this->isNeedCall()
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
                return $this->getTripFormattedPrice() ?? '';
            })
                ->readonly()
                ->asHtml(),

            CustomStatusBadge::make(__('Apmokėjimo statusas'), 'paid_type')
                ->withMeta([
                    'paidType' => $this->getTripCustomerPaidType() ?? '',
                ])->exceptOnForms(),

            Text::make(__('Bilietas'), function () {
                $ticket = $this->getTripCustomerTicketCode($this->id);

                if ($this->isPayed() || is_object($ticket)) {
                    $url = url("/nova/resources/trip-customer-tickets/{$ticket->id}");
                    return <<<HTML
                        <a target="_blank" class="flex items-center text-primary font-bold no-underline" href="{$url}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 mr-1">
                                <path fill-rule="evenodd" d="M13 3v1.27a.75.75 0 001.5 0V3h2.25A2.25 2.25 0 0119 5.25v2.628a.75.75 0 01-.5.707 1.5 1.5 0 000 2.83c.3.106.5.39.5.707v2.628A2.25 2.25 0 0116.75 17H14.5v-1.27a.75.75 0 00-1.5 0V17H3.25A2.25 2.25 0 011 14.75v-2.628c0-.318.2-.601.5-.707a1.5 1.5 0 000-2.83.75.75 0 01-.5-.707V5.25A2.25 2.25 0 013.25 3H13zm1.5 4.396a.75.75 0 00-1.5 0v1.042a.75.75 0 001.5 0V7.396zm0 4.167a.75.75 0 00-1.5 0v1.041a.75.75 0 001.5 0v-1.041zM6 10.75a.75.75 0 01.75-.75h3.5a.75.75 0 010 1.5h-3.5a.75.75 0 01-.75-.75zm0 2.5a.75.75 0 01.75-.75h1.5a.75.75 0 010 1.5h-1.5a.75.75 0 01-.75-.75z" clip-rule="evenodd" />
                            </svg>
                            {$ticket->code}
                        </a>
                    HTML;
                } else {
                    return '-';
                }
            })->asHtml(),
        ];
    }

    public function actions(Request $request): array
    {
        return [
            (new PaymentTicketAction())
                ->confirmText(__('Ar tikrai norite sumokėti už šią kelionę? ir "Pirkti bilietą"'))
                ->confirmButtonText(__('Mokėti'))
                ->cancelButtonText(_('Atšaukti')),
            (new PaymentTicketCanceledAction())
                ->confirmText(__('Ar tikrai norite atšauktį "Mokėjimą"'))
                ->confirmButtonText(__('Atšaukti mokėjimą'))
                ->cancelButtonText(_('Atšaukti')),
        ];
    }
}
