<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Trip extends Model
{
    use HasFactory;

    protected $table = 'trips';

    protected $guarded = ['id'];

    public function bus(): BelongsTo
    {
        return $this->belongsTo(Bus::class);
    }
}
