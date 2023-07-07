<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\TripCustomerTicket;

class GenerateTickedService
{
    protected string $prefix = 'BIL';

    public function generateTicketCode(): string
    {
        $nextId = TripCustomerTicket::getNextId();
        return $this->formatTicketCode($nextId);
    }

    private function formatTicketCode(int $id): string
    {
        return $this->prefix . str_pad((string)$id, 6, '0', STR_PAD_LEFT);
    }
}
