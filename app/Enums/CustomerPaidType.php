<?php

namespace App\Enums;

use Spatie\Enum\Enum;

class CustomerPaidType extends Enum
{
    public const PONES = 'mis';
    public const PONNIAH = 'mr';

    public static function values(): array
    {
        return [
            self::PONES,
            self::PONNIAH,
        ];
    }

    public static function labels(): array
    {
        return [
            self::PONES => __('Ponas'),
            self::PONNIAH => __('Ponia'),
        ];
    }

    public static function isValid($value): bool
    {
        return in_array($value, self::values());
    }
}
