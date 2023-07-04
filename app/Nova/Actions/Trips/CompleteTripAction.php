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
        [$completedCount, $alreadyCompletedCount] = $this->processModels($models);

        if ($alreadyCompletedCount > 0) {
            return $this->generateAlreadyCompletedAction($alreadyCompletedCount);
        }

        return $this->generateCompletionAction($completedCount);
    }

    private function processModels(Collection $models): array
    {
        $completedCount = 0;
        $alreadyCompletedCount = 0;

        foreach ($models as $model) {
            if ($model->isAlreadyCompleted()) {
                $alreadyCompletedCount++;
            } else {
                $this->completeModel($model);
                $completedCount++;
            }
        }

        return [$completedCount, $alreadyCompletedCount];
    }

    private function generateAlreadyCompletedAction(int $count): array
    {
        $message = $count > 1
            ? __("Šios +{$count} kelionės jau užbaigtos.")
            : __('Šį kelionė jau užbaigta.');

        return Action::danger($message);
    }

    private function generateCompletionAction(int $count): array
    {
        $message = $count > 1
            ? __("Užbaigtos +{$count} kelionės sėkmingai.")
            : __('Kelionė buvo užbaigta sėkmingai.');

        return Action::message($message);
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
