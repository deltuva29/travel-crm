<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusFeature extends Model
{
    use HasFactory;

    protected $table = 'bus_features';

    protected $guarded = ['id'];

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public static function getArrayOfAllFeaturesForFilters()
    {
        return self::orderBy('name', 'asc')
            ->get()
            ->pluck('id', 'name')
            ->toArray();
    }
}
