<?php

namespace App\Nova\Actions\Buses;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class UpdateUnAvailableBusAction extends Action
{
    use InteractsWithQueue, Queueable;

    public function name(): string
    {
        return __('Užimtas');
    }

    public function handle(ActionFields $fields, Collection $models)
    {
        return $this->makeBusUnAvailable($models);
    }

    private function makeBusUnAvailable(Collection $models): array
    {
        [$availableCount, $alreadyAvailableCount] = $this->processModels($models);

        if ($alreadyAvailableCount > 0) {
            return $this->generateAlreadyUnAvailableAction($alreadyAvailableCount);
        }

        return $this->generateUnAvailabilityAction($availableCount);
    }

    private function processModels(Collection $models): array
    {
        $availableCount = 0;
        $alreadyAvailableCount = 0;

        foreach ($models as $model) {
            if ($model->isAlreadyUnAvailable()) {
                $alreadyAvailableCount++;
            } else {
                $this->makeModelAvailable($model);
                $availableCount++;
            }
        }

        return [$availableCount, $alreadyAvailableCount];
    }

    private function generateAlreadyUnAvailableAction(int $count): array
    {
        $message = $count > 1
            ? __("Šie +{$count} autobusai jau užimti.")
            : __('Šis autobusas jau užimtas.');

        return Action::danger($message);
    }

    private function generateUnAvailabilityAction(int $count): array
    {
        $message = $count > 1
            ? __("Užimti +{$count} autobusai.")
            : __('Autobusas užimtas.');

        return Action::message($message);
    }

    private function makeModelAvailable($model): void
    {
        $model->update(['available' => true]);
    }

    public function fields(): array
    {
        return [];
    }
}
