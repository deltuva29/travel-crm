<?php

namespace App\Enums;

use Spatie\Enum\Enum;

class CustomerType extends Enum
{
    public const RENTER = 'renter';
    public const PARTICIPANT = 'participant';

//    public const COMPANY = 'company';

    public static function values(): array
    {
        return [
            self::RENTER,
            self::PARTICIPANT,
            self::COMPANY,
        ];
    }

    public static function labels(): array
    {
        return [
            self::RENTER => __('Nuomotojas - autobuso nuomos registravimas'),
            self::PARTICIPANT => __('Kelionės dalyvis - naujos kelionės dalyvio registravimas'),
            self::COMPANY => __('Įmonės - organizacijos registravimas'),
        ];
    }

    public static function isValid($value): bool
    {
        return in_array($value, self::values());
    }
}
