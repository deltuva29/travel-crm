<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Bus extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'buses';

    protected $guarded = ['id'];

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function features(): BelongsToMany
    {
        return $this->belongsToMany(BusFeature::class, 'bus_feature_buses', 'bus_id', 'bus_feature_id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(BusType::class);
    }

    public function types(): HasMany
    {
        return $this->hasMany(BusType::class, 'id', 'type_id');
    }
}
