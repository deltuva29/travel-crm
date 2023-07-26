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
        } catch (Exception $ex) {
            session()->flash('error', $ex->getMessage());
            return false;
        }
    }
}
