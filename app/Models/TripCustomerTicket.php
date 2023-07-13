<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TripCustomerTicket extends Model
{
    use HasFactory;

    protected $table = 'trip_customer_tickets';

    protected $guarded = ['id', 'uuid'];

    protected $casts = [
        'paid_at' => 'datetime',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function trip(): BelongsTo
    {
        return $this->belongsTo(Trip::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function formatPrice(): string
    {
        return number_format($this->price, 2, '.', '') . ' €';
    }

    public static function getNextId(): int
    {
        return static::query()->max('id') + 1;
    }

    public function getTripRouteFullName(): string
    {
        return $this->trip->route->fullName ?? '';
    }
}
