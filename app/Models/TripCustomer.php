<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function getPriceOfTrip()
    {
        return $this->trip?->formatPrice();
    }

    public function getPaidType(): string
    {
        return $this->paid_type ?? 'N/A';
    }
}
