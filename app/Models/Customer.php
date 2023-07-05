<?php

namespace App\Models;

use App\Enums\CustomerCompanyPrefixType;
use App\Enums\CustomerType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
        return $this->isCompany()
            ? $this->getCompanyFullName()
            : $this->getIndividualFullName();
    }

    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(Customer::class, 'trip_customers', 'customer_id', 'trip_id');
    }

    public function trip(): BelongsTo
    {
        return $this->belongsTo(Trip::class);
    }

    public function isCompany(): bool
    {
        return $this->type === CustomerType::COMPANY;
    }

    public function getCompanyFullName($prefix = false): string
    {
        if (!$prefix) {
            $iv = $this->getCompanyPrefixLabel();
            return $iv . ' "' . $this->attributes['company_prefix'] . '" ' . $this->attributes['company_name'];
        } else {
            return '"' . $this->attributes['company_prefix'] . '" ' . $this->attributes['company_name'];
        }
    }

    public function getIndividualFullName(): string
    {
        return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
    }

    public function getCompanyPrefixLabel(): string
    {
        $prefix = $this->attributes['company_prefix'];

        return $this->isCompanyPrefixIV($prefix)
            ? __('Individuali veikla')
            : __('Įmonė');
    }

    public function isCompanyPrefixIV($prefix): bool
    {
        return $prefix === CustomerCompanyPrefixType::IV;
    }

    public static function getCustomerTypeLabel($type, $prefix = ''): string
    {
        $iv = $prefix == CustomerCompanyPrefixType::IV
            ? __('Individuali veikla')
            : __('Įmonė');

        return match ($type) {
            CustomerType::RENTER => __('Nuomotojas'),
            CustomerType::PASSENGER => __('Keleivis'),
            CustomerType::COMPANY => $iv,
            default => '',
        };
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}
