<?php

namespace App\Nova\Actions\Trips;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class CompleteTripAction extends Action
{
    use InteractsWithQueue, Queueable;

    public function name(): string
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
