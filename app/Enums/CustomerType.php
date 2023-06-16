<?php

namespace App\Enums;

use Spatie\Enum\Enum;

class CustomerType extends Enum
{
    public const RENT = 'rent';
    public const PASSENGER = 'passenger';

    public static function values(): array
    {
        return [
            self::RENT => __('Nuoma'),
            self::PASSENGER => __('Keleivis'),
        ];
    }

    public static function isValid($value): bool
    {
        return in_array($value, self::values());
    }
}
