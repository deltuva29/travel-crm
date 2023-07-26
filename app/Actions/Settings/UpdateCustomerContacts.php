<?php

namespace App\Actions\Settings;

use Exception;

class UpdateCustomerContacts
{
    public function execute(array $form, $customer): bool
    {
        try {
            $participant = $form['participant'];
            $renter = $form['renter'];
            $customerData = [
                'first_name' => $participant['first_name'] ?? null,
                'last_name' => $participant['last_name'] ?? null,
                'phone' => $participant['phone_number'] ?? null
            ];

            if ($customer->isRenter()) {
                $customerData = [
                    'first_name' => $renter['first_name'] ?? null,
                    'last_name' => $renter['last_name'] ?? null,
                    'phone' => $renter['phone_number'] ?? null,
                    'address' => $renter['address'] ?? null
                ];
            }
            $customer->update($customerData);

            return true;
        } catch (Exception $ex) {
            session()->flash('error', $ex->getMessage());

            return false;
        }
    }
}
