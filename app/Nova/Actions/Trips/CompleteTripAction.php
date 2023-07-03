<?php

namespace App\Nova\Actions\Trips;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class CompleteTripAction extends Action
{
    use InteractsWithQueue, Queueable;

    public function name(): array|string|Translator|Application|null
    {
        return __('Užbaigti kelionę');
    }

    public function handle(ActionFields $fields, Collection $models)
    {
        //
    }

    public function fields()
    {
        return [];
    }
}
