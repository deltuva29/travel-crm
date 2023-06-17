<?php

namespace App\Enums;

use Spatie\Enum\Enum;

class CustomerType extends Enum
{
    public const RENT = 'rent';
    public const PASSENGER = 'passenger';
    public const COMPANY_ORGANIZATION = 'organization';

    public static function values(): array
    {
        return [
            self::RENT,
            self::PASSENGER,
            self::COMPANY_ORGANIZATION,
        ];
    }

    public static function labels(): array
    {
        return [
            self::RENT => __('Nuoma'),
            self::PASSENGER => __('Keleivis'),
            self::COMPANY_ORGANIZATION => __('Imonė/Kompanija'),
        ];
    }

    public static function isValid($value): bool
    {
        return in_array($value, self::values());
    }
}
