<?php

namespace App\Models;

use App\Enums\CustomerPaidType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TripCustomer extends Model
{
    use HasFactory;

    protected $table = 'trip_customers';

    protected $guarded = ['id'];

    public function trip(): BelongsTo
    {
        return $this->belongsTo(Trip::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function tickets(): BelongsToMany
    {
        return $this->belongsToMany(Trip::class, 'trip_customer_tickets', 'trip_id', 'customer_id');
    }

    public function getTripCustomerTicketCode(int $tripCustomerId)
    {
        $ticket = TripCustomerTicket::query()
            ->where('trip_customer_id', $tripCustomerId)
            ->whereNotNull('paid_at')
            ->first();

        return $ticket ?? '-';
    }

    public function getTripFormattedPrice()
    {
        return $this->trip->formatPrice();
    }

    public function isPayed(): bool
    {
        return $this->paid_type == CustomerPaidType::PAYMENT_SUCCESS;
    }

    public function isNoted(): bool
    {
        return !is_null($this->note);
    }

    public function isNeedCall(): bool
    {
        return $this->need_call;
    }

    public function getCustomerFullName(): string
    {
        return $this->customer->fullName ?? '';
    }

    public function getNoteLikeComment(): string
    {
        return $this->note ?? '';
    }

    public function getTripCustomerPaidType(): string
    {
        return $this->paid_type ?? 'N/A';
    }
}
