<?php

namespace App\Actions\Settings;

use Exception;

class RemoveCustomerAvatar
{
    public function execute($customer): bool
    {
        try {
            $customer->clearMediaCollection('avatar');

            return true;
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
            return false;
        }
    }
}
