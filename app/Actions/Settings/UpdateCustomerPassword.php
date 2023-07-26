<?php

namespace App\Actions\Settings;

use App\DTO\UpdateCustomerPasswordDTO;
use Exception;
use Hash;

class UpdateCustomerPassword
{
    public function execute(UpdateCustomerPasswordDTO $dto): bool
    {
        try {
            if (!Hash::check($dto->getCurrentPassword(), $dto->getCustomer()->password ?? '')) {
                return false;
            }
            $dto->getCustomer()->update([
                'password' => bcrypt($dto->getNewPassword()),
            ]);

            return true;
        } catch (Exception $ex) {
            session()->flash('error', $ex->getMessage());

            return false;
        }
    }
}
