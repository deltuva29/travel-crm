<?php

namespace App\Enums;

use Spatie\Enum\Enum;

class PriceType extends Enum
{
    public const HOURLY = 'Hourly';
    public const DAILY = 'Daily';
    public const WEEKLY = 'Weekly';
    public const MONTHLY = 'Monthly';

    public static function values(): array
    {
        return [
            self::HOURLY,
            self::DAILY,
            self::WEEKLY,
            self::MONTHLY,
        ];
    }

    public static function isValid($value): bool
    {
        return in_array($value, self::values());
    }
}
