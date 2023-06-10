<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusFeature extends Model
{
    use HasFactory;

    protected $table = 'bus_features';

    protected $guarded = ['id'];
}
