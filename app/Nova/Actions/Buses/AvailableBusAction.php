<?php

namespace App\Nova\Actions\Buses;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class AvailableBusAction extends Action
{
    use InteractsWithQueue, Queueable;

    public function name(): string
    {
        return __('Laisvas');
    }

    public function handle(ActionFields $fields, Collection $models)
    {
        return $this->makeBusAvailable($models);
    }

    private function makeBusAvailable(Collection $models): array
    {
        [$availableCount, $alreadyAvailableCount] = $this->processModels($models);

        if ($alreadyAvailableCount > 0) {
            return $this->generateAlreadyAvailableAction($alreadyAvailableCount);
        }

        return $this->generateAvailabilityAction($availableCount);
    }

    private function processModels(Collection $models): array
    {
        $availableCount = 0;
        $alreadyAvailableCount = 0;

        foreach ($models as $model) {
            if ($model->isAlreadyAvailable()) {
                $alreadyAvailableCount++;
            } else {
                $this->makeModelAvailable($model);
                $availableCount++;
            }
        }

        return [$availableCount, $alreadyAvailableCount];
    }

    private function generateAlreadyAvailableAction(int $count): array
    {
        $message = $count > 1
            ? __("Šie +{$count} autobusai jau prieinami.")
            : __('Šis autobusas jau yra prieinamas.');

        return Action::danger($message);
    }

    private function generateAvailabilityAction(int $count): array
    {
        $message = $count > 1
            ? __("Prieinami +{$count} autobusai.")
            : __('Autobusas yra prieinamas.');

        return Action::message($message);
    }

    private function makeModelAvailable($model): void
    {
        $model->update(['available' => false]);
    }

    public function fields(): array
    {
        return [];
    }
}
