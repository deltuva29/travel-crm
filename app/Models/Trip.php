<?php

namespace App\Models;

use App\Enums\RoleType;
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

    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'driver_id')
            ->whereHas('roles', fn($q) => $q->where('name', RoleType::IS_DRIVER));
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id')
            ->whereHas('roles', fn($q) => $q->where('name', RoleType::IS_EMPLOYEE));
    }
}
