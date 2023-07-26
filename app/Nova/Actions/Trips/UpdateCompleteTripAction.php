<?php

namespace App\Nova\Actions\Trips;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class UpdateCompleteTripAction extends Action
{
    use InteractsWithQueue, Queueable;

    public function name(): string
    {
        return __('Atnaujinti kelionės statusą');
    }

    public function handle(ActionFields $fields, Collection $models): array
    {
        return $this->uncompletedModels($models);
    }

    private function uncompletedModels(Collection $models): array
    {
        [$completedCount, $alreadyCompletedCount] = $this->processModels($models);

        if ($alreadyCompletedCount > 0) {
            return $this->generateAlreadyUnCompletedAction($alreadyCompletedCount);
        }

        return $this->generateUnCompletionAction($completedCount);
    }

    private function processModels(Collection $models): array
    {
        $completedCount = 0;
        $alreadyCompletedCount = 0;

        foreach ($models as $model) {
            if ($model->isAlreadyUnCompleted()) {
                $alreadyCompletedCount++;
            } else {
                $this->completeModel($model);
                $completedCount++;
            }
        }

        return [$completedCount, $alreadyCompletedCount];
    }

    private function generateAlreadyUnCompletedAction(int $count): array
    {
        $message = $count > 1
            ? __("Šiu +{$count} kelionių statusas jau buvo atnaujintas.")
            : __('Šis kelionės statusas jau atnaujintas.');

        return Action::danger($message);
    }

    private function generateUnCompletionAction(int $count): array
    {
        $message = $count > 1
            ? __("Atnaujintos +{$count} kelionės sėkmingai.")
            : __('Kelionė statusas buvo atnaujintas sėkmingai.');

        return Action::message($message);
    }

    private function completeModel($model): void
    {
        $model->update(['completed_at' => null]);
    }

    public function fields(): array
    {
        return [];
    }
}
