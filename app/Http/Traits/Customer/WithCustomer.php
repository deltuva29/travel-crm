<?php

namespace App\Http\Traits\Customer;

use App\Http\Traits\ContentLoader\WithContentLoader;
use App\Models\Customer;

trait WithCustomer
{
    use WithContentLoader;

    public ?Customer $customer = null;

    public function mount(): void
    {
        $this->initBackgroundLoader();
        $this->customer = auth('customer')->user();

        if ($this->customer !== null) {
            $this->initFormWithCustomerParticipantData();
        }
    }

    protected function initFormWithCustomerParticipantData(): void
    {
        $this->form['participant']['first_name'] = $this->customer->first_name ?? null;
        $this->form['participant']['last_name'] = $this->customer->last_name ?? null;
        $this->form['participant']['email'] = $this->customer->email ?? null;
        $this->form['participant']['phone_number'] = $this->customer->phone ?? null;
    }
}
