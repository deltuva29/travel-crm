<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusRent extends Model
{
    use HasFactory;

    protected $table = 'bus_rents';

    protected $guarded = ['id'];
}
