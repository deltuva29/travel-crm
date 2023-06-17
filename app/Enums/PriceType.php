<?php

namespace App\Enums;

use Spatie\Enum\Enum;

class PriceType extends Enum
{
    public const HOURLY = 'hourly';
    public const DAILY = 'daily';
    public const WEEKLY = 'weekly';
    public const MONTHLY = 'monthly';

    public static function values(): array
    {
        return [
            self::HOURLY,
            self::DAILY,
            self::WEEKLY,
            self::MONTHLY,
        ];
    }

    public static function labels(): array
    {
        return [
            self::HOURLY => __('Valandos'),
            self::DAILY => __('Dienos'),
            self::WEEKLY => __('Savaitės'),
            self::MONTHLY => __('Menuo'),
        ];
    }

    public static function isValid($value): bool
    {
        return in_array($value, self::values());
    }
}
