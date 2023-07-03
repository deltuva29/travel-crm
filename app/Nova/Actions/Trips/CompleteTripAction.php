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
        return $this->completeModels($models);
    }

    private function completeModels(Collection $models): array
    {
        foreach ($models as $model) {
            if ($model->isAlreadyCompleted()) {
                return Action::danger('Šį kelionė jau užbaigta.');
            } else {
                $this->completeModel($model);
            }
        }

        return Action::message(__('Kelionė buvo užbaigta sėkmingai.'));
    }

    private function completeModel($model): void
    {
        $model->update(['completed_at' => now()]);
    }

    public function fields(): array
    {
        return [];
    }
}
