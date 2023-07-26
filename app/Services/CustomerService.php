<?php
declare(strict_types=1);

namespace App\Services;

use App\Enums\CustomerType;

class CustomerService
{
    public function initCustomerData($type, $customer): array
    {
        $customerData = [
            'first_name' => $customer->first_name ?? null,
            'last_name' => $customer->last_name ?? null,
            'email' => $customer->email ?? null,
            'phone_number' => $customer->phone ?? null,
        ];

        switch ($type) {
            case CustomerType::RENTER:
                $customerData['address'] = $this->getRenterData($customer);
                break;

            case CustomerType::COMPANY:
                $customerData = array_merge($customerData, $this->getCompanyData($customer));
                break;
        }

        return [$type => $customerData];
    }

    private function getRenterData($customer): ?string
    {
        return $customer->address;
    }

    private function getCompanyData($customer): array
    {
        return [
            'company_name' => $customer->company_name ?? null,
            'company_prefix' => $customer->company_prefix ?? null,
            'company_first_name' => $customer->first_name ?? null,
            'company_last_name' => $customer->last_name ?? null,
        ];
    }
}
