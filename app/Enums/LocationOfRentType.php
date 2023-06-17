<?php

namespace App\Enums;

use Spatie\Enum\Enum;

class LocationOfRentType extends Enum
{
    public const LITHUANIA = 'lithuania';
    public const EUROPE = 'europe';
    public const OTHER = 'other';

    public static function values(): array
    {
        return [
            self::LITHUANIA,
            self::EUROPE,
            self::OTHER,
        ];
    }

    public static function labels(): array
    {
        return [
            self::LITHUANIA => __('Lietuva'),
            self::EUROPE => __('Europa'),
            self::OTHER => __('Kita'),
        ];
    }

    public static function isValid($value): bool
    {
        return in_array($value, self::values());
    }
}
