<?php

namespace App\Actions\Settings;

use Exception;
use Hash;

class UpdateCustomerPassword
{
    /**
     * @throws Exception
     */
    public function execute($currentPassword, $customer, $newPassword): bool
    {
        try {
            if (!Hash::check($currentPassword, $customer->password ?? '')) {
                return false;
            }
            $customer->update([
                'password' => Hash::make($newPassword),
            ]);

            return true;
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());

            return false;
        }
    }
}
