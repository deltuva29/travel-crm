<?php

namespace App\Nova\Metrics\CustomerTickets;

use App\Models\TripCustomerTicket as Ticket;
use Laravel\Nova\Metrics\Value;
use Laravel\Nova\Metrics\ValueResult;

class CountTicketEarnings extends Value
{
    public function name(): string
    {
        return __('Viso uždirbta iš pardavimų');
    }

    public function calculate(): ValueResult
    {
        $range = request()->input('range');
        $query = Ticket::query()->whereNotNull('paid_at');

        $this->setDateRangeQuery($query, $range);

        return $this->result($query->sum('price'))
            ->prefix('€');
    }

    private function setDateRangeQuery($query, $range): void
    {
        $dateRangeDefinitions = [
            'TODAY' => fn() => $query->whereDate('paid_at', today()),
            'MTD' => fn() => $query->whereMonth('paid_at', now()->month)
                ->whereYear('paid_at', now()->year),
            'QTD' => fn() => $query->whereBetween('paid_at', [now()->startOfQuarter(), now()->endOfQuarter()])
        ];

        if (isset($dateRangeDefinitions[$range])) {
            $dateRangeDefinitions[$range]();
        } else {
            $query->where('paid_at', '>=', now()->subDays((int)$range));
        }
    }

    public function ranges(): array
    {
        return [
            30 => __('30 Days'),
            60 => __('60 Days'),
            365 => __('365 Days'),
            'TODAY' => __('Today'),
            'MTD' => __('Month To Date'),
            'QTD' => __('Quarter To Date'),
            'YTD' => __('Year To Date'),
        ];
    }

    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    public function uriKey(): string
    {
        return 'customer-tickets-count-ticket-earnings';
    }
}
