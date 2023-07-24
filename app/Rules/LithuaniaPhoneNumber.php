<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class LithuaniaPhoneNumber implements Rule
{
    public function passes($attribute, $value): bool
    {
        return preg_match('/^\+370\d{8}$/', $value) > 0;
    }

    public function message(): string
    {
        return __('Blogas tel.numerio formatas pvz: +370xxx');
    }
}
