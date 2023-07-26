<?php

namespace App\Nova\Actions\Trips\Customers;

use App\Enums\CustomerPaidType;
use App\Services\GenerateTickedService;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class PaymentTicketAction extends Action
{
    use InteractsWithQueue, Queueable;

    public function name(): string
    {
        return __('Apmokėjimas');
    }

    public function handle(ActionFields $fields, Collection $models): array
    {
        return $this->processModels($models);
    }

    private function processModels(Collection $models): array
    {
        try {
            foreach ($models as $model) {
                if ($model->isPayed()) {
                    return Action::danger(__('Šį kelionė jau apmokėta.'));
                } else {
                    $this->paidModel($model);
                    return Action::message(__('Sėkmingai sumokėjote už ' . $model->getCustomerFullName() . ' kelionę.'));
                }
            }
        } catch (Exception $e) {
            return Action::danger(__('Klaida sumokant už kelionę.'));
        }
        return [];
    }

    private function paidModel($model): void
    {
        $generateTickedService = new GenerateTickedService();

        $model->tickets()->attach($model->trip_id, [
            'uuid' => (string)str()->uuid(),
            'trip_customer_id' => $model->id,
            'trip_id' => $model->trip_id,
            'customer_id' => $model->customer_id,
            'user_id' => auth()->id(),
            'code' => $generateTickedService->generateTicketCode(),
            'price' => (int)$model->trip->price,
            'paid_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $model->update(['paid_type' => CustomerPaidType::PAYMENT_SUCCESS]);
    }

    public function fields(): array
    {
        return [];
    }
}
