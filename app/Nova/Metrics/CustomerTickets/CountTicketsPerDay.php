<?php

namespace App\Nova\Metrics\CustomerTickets;

use App\Models\TripCustomerTicket as Ticket;
use Laravel\Nova\Metrics\Trend;
use Laravel\Nova\Metrics\TrendResult;

class CountTicketsPerDay extends Trend
{
    public function name(): string
    {
        return __('Vidutiniškai per dieną');
    }

    public function calculate(): TrendResult
    {
        $query = Ticket::query()->whereNotNull('paid_at');
        $results = $this->averageByDays(request(), $query, 'price');
        $resultCount = collect($results->trend)->sum('value');

        return $results->result($resultCount)
            ->showLatestValue()
            ->format('0,0.00')
            ->prefix('€');
    }

    protected function showZeroResult($result): TrendResult
    {
        return $this->result($result);
    }

    public function ranges(): array
    {
        return [
            30 => __('30 Days'),
            60 => __('60 Days'),
            90 => __('90 Days'),
        ];
    }

    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    public function uriKey(): string
    {
        return 'customer-tickets-count-tickets-per-day';
    }
}
