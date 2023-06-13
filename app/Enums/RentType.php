<?php

namespace App\Enums;

use Spatie\Enum\Enum;

class RentType extends Enum
{
    public const TRIPS = 'trips';
    public const EXCURSIONS = 'excursions';

    public static function values(): array
    {
        return [
            self::TRIPS,
            self::EXCURSIONS,
        ];
    }

    public static function isValid($value): bool
    {
        return in_array($value, self::values());
    }
}
