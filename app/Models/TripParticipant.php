<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripParticipant extends Model
{
    use HasFactory;

    protected $table = 'trip_customer_trips';

    protected $guarded = ['id'];
}
