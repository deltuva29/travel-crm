<?php

namespace App\Nova\Actions\Trips\Customers;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class PaymentTicketNeedCallAction extends Action
{
    use InteractsWithQueue, Queueable;

    public function name(): string
    {
        return __('Skambutis');
    }

    public function handle(ActionFields $fields, Collection $models)
    {
        return $this->processModels($fields, $models);
    }

    private function processModels(ActionFields $fields, Collection $models): array
    {
        try {
            foreach ($models as $model) {
                $this->paidModel($fields, $model);
                if ($model->isNeedCall()) {
                    return Action::message(__('Susisieksime su ' . $model->getCustomerFullName() . '.'));
                } else {
                    return Action::danger(__('Skambutis ' . $model->getCustomerFullName() . ' atšauktas.'));
                }
            }
        } catch (Exception $e) {
            return Action::danger(__('Klaida nustatant skambutį.'));
        }
        return [];
    }

    private function paidModel(ActionFields $fields, $model): void
    {
        $model->update([
            'need_call' => !$model->need_call
        ]);
    }

    public function fields(): array
    {
        return [];
    }
}
