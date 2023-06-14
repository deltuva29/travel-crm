<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class LicenseNumberPlate implements Rule
{
    public function passes($attribute, $value): bool|int
    {
        return preg_match('/^[A-Z]{3}\s\d{3}$/', $value);
    }

    public function message(): string
    {
        return __(':attribute turi būti formato "ABC 123".');
    }
}
