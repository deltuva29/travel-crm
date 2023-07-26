<?php
declare(strict_types=1);

namespace App\Services;

use App\Enums\CustomerType;

class CustomerService
{
    public function initCustomerData($type, $customer): array
    {
        $returnData = [
            $type => [
                'first_name' => $customer->first_name ?? null,
                'last_name' => $customer->last_name ?? null,
                'email' => $customer->email ?? null,
                'phone_number' => $customer->phone ?? null,
            ]
        ];

        if ($type === CustomerType::RENTER) {
            $returnData[$type]['address'] = $customer->address ?? null;
        }

        return $returnData;
    }
}
