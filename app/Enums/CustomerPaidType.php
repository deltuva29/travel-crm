<?php

namespace App\Enums;

use Spatie\Enum\Enum;

class CustomerPaidType extends Enum
{
    public const PAYMENT_WAITING = 'waiting';
    public const PAYMENT_SUCCESS = 'paid';
    public const PAYMENT_FAILED = 'failed';

    public static function values(): array
    {
        return [
            self::PAYMENT_WAITING,
            self::PAYMENT_SUCCESS,
            self::PAYMENT_FAILED,
        ];
    }

    public static function labels(): array
    {
        return [
            self::PAYMENT_WAITING => __('Laukiama'),
            self::PAYMENT_SUCCESS => __('Apmokėta'),
            self::PAYMENT_FAILED => __('Atšaukta'),
        ];
    }

    public static function isValid($value): bool
    {
        return in_array($value, self::values());
    }
}
