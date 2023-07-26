<?php

namespace App\Actions\Settings;

use Exception;

class UpdateCustomerContacts
{
    public function execute(array $form, $customer): bool
    {
        try {
            return $this->updateCustomer($form, $customer);
        } catch (Exception $ex) {
            session()->flash('error', $ex->getMessage());

            return false;
        }
    }

    protected function updateCustomer(array $form, $customer): bool
    {
        $customerData = $this->getCustomerData($form, $customer);

        $customer->update($customerData);

        return true;
    }

    protected function getCustomerData(array $form, $customer): array
    {
        switch (true) {
            case $customer->isRenter():
                $relevantData = $form['renter'] ?? [];
                return $this->getRenterData($relevantData);
            case $customer->isCompany():
                $relevantData = $form['company'] ?? [];
                return $this->getCompanyData($relevantData);
            default:
                $relevantData = $form['participant'] ?? [];
                return $this->getParticipantData($relevantData);
        }
    }

    protected function getRenterData(array $renter): array
    {
        return [
            'first_name' => $renter['first_name'] ?? null,
            'last_name' => $renter['last_name'] ?? null,
            'phone' => $renter['phone_number'] ?? null,
            'address' => $renter['address'] ?? null
        ];
    }

    protected function getCompanyData(array $company): array
    {
        return [
            'company_name' => $company['company_name'] ?? null,
            'company_prefix' => $company['company_prefix'] ?? null,
            'first_name' => $company['first_name'] ?? null,
            'last_name' => $company['last_name'] ?? null
        ];
    }

    protected function getParticipantData(array $participant): array
    {
        return [
            'first_name' => $participant['first_name'] ?? null,
            'last_name' => $participant['last_name'] ?? null,
            'phone' => $participant['phone_number'] ?? null
        ];
    }
}
