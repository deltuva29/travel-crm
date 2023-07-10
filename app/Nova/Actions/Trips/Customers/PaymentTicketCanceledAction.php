<?php

namespace App\Nova\Actions\Trips\Customers;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Textarea;

class PaymentTicketCanceledAction extends Action
{
    use InteractsWithQueue, Queueable;

    public function name(): string
    {
        return __('Atšaukti mokėjimą');
    }

    public function handle(ActionFields $fields, Collection $models)
    {
        return $this->processModels($fields, $models);
    }

    private function processModels(ActionFields $fields, Collection $models): array
    {
        try {
            foreach ($models as $model) {
                if ($model->isNoted()) {
                    return Action::danger(__('Šis mokėjimas jau atšauktas.'));
                } else {
                    $this->paidModel($fields, $model);
                    return Action::message(__('Sėkmingai atšaukėte ' . $model->getCustomerFullName() . ' mokėjimą.'));
                }
            }
        } catch (Exception $e) {
            return Action::danger(__('Klaida atšaukiant mokėjimą.'));
        }
        return [];
    }

    private function paidModel(ActionFields $fields, $model): void
    {
//        $model->update([
//            'note' => $fields->note,
//            'paid_type' => CustomerPaidType::PAYMENT_FAILED
//        ]);
        $model->tickets()->update([
            'trip_customer_id' => $model->trip_customer_id ?? null,
        ], ['paid_at' => null]);
    }

    public function fields(): array
    {
        return [
            Textarea::make(__('Priežastis'), 'note')
                ->rules('required')
                ->rows(6),
        ];
    }
}
