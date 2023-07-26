<?php

namespace App\DTO;

use App\Models\Customer;

class UpdateCustomerPasswordDTO
{
    private string $currentPassword;
    private Customer $customer;
    private string $newPassword;

    public static function fromRequest(string $currentPassword, Customer $customer, string $newPassword): self
    {
        $dto = new self();
        $dto->currentPassword = $currentPassword;
        $dto->customer = $customer;
        $dto->newPassword = $newPassword;

        return $dto;
    }

    public function getCurrentPassword(): string
    {
        return $this->currentPassword;
    }

    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    public function getNewPassword(): string
    {
        return $this->newPassword;
    }
}
