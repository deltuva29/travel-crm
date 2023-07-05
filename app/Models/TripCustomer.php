<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripCustomer extends Model
{
    use HasFactory;

    protected $table = 'trip_customers';

    protected $guarded = ['id'];
}
