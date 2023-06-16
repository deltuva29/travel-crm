<?php

namespace App\Rules;

use App\Models\Bus;
use Illuminate\Contracts\Validation\Rule;

class AvailableBus implements Rule
{
    public mixed $startDateTime;
    public mixed $endDateTime;

    public function __construct()
    {
        $this->startDateTime = request()->input('start_time');
        $this->endDateTime = request()->input('end_time');
    }

    public function passes($attribute, $value): bool
    {
        $bus = Bus::find($value);

        if (!$bus) {
            return false;
        }

        $startParsedDateTimeAt = now()->parse($this->startDateTime);
        $endParsedDateTimeAt = now()->parse($this->endDateTime);

        return $bus->isAvailableForRent($startParsedDateTimeAt, $endParsedDateTimeAt);
    }

    public function message(): string
    {
        return __('Pasirinktai datai autobusas yra jau užimtas.');
    }
}
