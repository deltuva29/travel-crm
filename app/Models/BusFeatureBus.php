<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusFeatureBus extends Model
{
    use HasFactory;

    protected $table = 'bus_feature_buses';

    protected $guarded = ['id'];
}
