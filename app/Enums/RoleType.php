<?php

namespace App\Enums;

use Spatie\Enum\Enum;

class RoleType extends Enum
{
    public const IS_DRIVER = 'Vairuotojas';
    public const IS_EMPLOYEE = 'Darbuotojas';
}
