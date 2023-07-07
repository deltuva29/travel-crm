<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $table = 'routes';

    protected $guarded = ['id'];

    protected $appends = ['full_name'];

    public function getFullNameAttribute(): string
    {
        return $this->attributes['from'] . ' - ' . $this->attributes['to'];
    }
}
