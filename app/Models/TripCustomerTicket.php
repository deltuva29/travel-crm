<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripCustomerTicket extends Model
{
    use HasFactory;

    protected $table = 'trip_customer_tickets';

    protected $guarded = ['id'];

    public static function getNextId(): int
    {
        return static::query()->max('id') + 1;
    }
}
