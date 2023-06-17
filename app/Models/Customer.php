<?php

namespace App\Models;

use App\Enums\CustomerCompanyPrefixType;
use App\Enums\CustomerType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Customer extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'customers';

    protected $guarded = ['id'];

    protected $appends = ['full_name'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')->singleFile();
    }

    public function getFullNameAttribute(): string
    {
        $iv = $this->company_prefix == CustomerCompanyPrefixType::IV ?
            __('Individuali veikla') :
            __('Įmonė');

        return match ($this->type) {
            CustomerType::COMPANY => $iv . ' "' . $this->attributes['company_prefix'] . '" ' . $this->attributes['company_name'],
            default => $this->attributes['first_name'] . ' ' . $this->attributes['last_name'],
        };
    }

    public static function getCustomerTypeLabel($type, $prefix = ''): string
    {
        $iv = $prefix == CustomerCompanyPrefixType::IV ?
            __('Individuali veikla') :
            __('Įmonė');

        return match ($type) {
            CustomerType::RENTER => __('Nuomotojas'),
            CustomerType::PASSENGER => __('Keleivis'),
            CustomerType::COMPANY => $iv,
            default => '',
        };
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
}
