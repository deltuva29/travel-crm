<?php

namespace App\Models;

use App\Enums\RoleType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Trip extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'trips';

    protected $guarded = ['id'];

    protected $dates = [
        'arrived_at',
        'departure_at',
        'completed_at',
    ];

    protected $casts = [
        'arrived_at' => 'date',
        'arrived_back_at' => 'string',
        'departure_at' => 'date',
        'departure_back_at' => 'string',
        'completed_at' => 'timestamp',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('main_image')->singleFile();
        $this->addMediaCollection('additional_images');
    }

    /**
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(120)
            ->sharpen(10)
            ->performOnCollections('main_image');
    }

    public function isAlreadyCompleted(): bool
    {
        return !is_null($this->completed_at);
    }

    public function isAlreadyUnCompleted(): bool
    {
        return is_null($this->completed_at);
    }

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

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(TripParticipant::class, 'trip_trip_participants', 'trip_id');
    }

    public function formatTime($column): string
    {
        $carbonTime = now()->createFromFormat('H:i:s', $this->{$column});

        $hours = $carbonTime->format('G');
        $minutes = $carbonTime->format('i');

        return sprintf('%d val %02d min', $hours, $minutes);
    }

    public function formatPrice(): string
    {
        return number_format($this->price, 2, '.', '') . ' €';
    }
}
