<?php

namespace App\Enums;

use Spatie\Enum\Enum;

class CustomerCompanyPrefixType extends Enum
{
    public const IV = 'IV';
    public const MB = 'MB';
    public const UAB = 'UAB';
    public const AB = 'AB';

    public static function values(): array
    {
        return [
            self::IV,
            self::MB,
            self::UAB,
            self::AB,
        ];
    }

    public static function labels(): array
    {
        return [
            self::IV => __('IV - Individuali veikla'),
            self::MB => __('MB - Mažoji bendrija'),
            self::UAB => __('UAB - Uždara akcinė bendrovė'),
            self::AB => __('AB - Akcinė bendrovė'),
        ];
    }

    public static function isValid($value): bool
    {
        return in_array($value, self::values());
    }
}
