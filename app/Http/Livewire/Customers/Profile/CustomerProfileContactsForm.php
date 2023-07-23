<?php

namespace App\Http\Livewire\Customers\Profile;

use App\Http\Requests\CustomerContactsUpdateRequest;
use App\Http\Traits\Customer\WithCustomer;
use App\Http\Traits\Form\WithDisableButton;
use App\Http\Traits\Toast\WithToast;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CustomerProfileContactsForm extends Component
{
    use WithToast,
        WithCustomer,
        WithDisableButton;

    public $form;

    public function updated($propertyForm): void
    {
        $this->checkForFieldEmptiness();

        $this->validateOnly($propertyForm,
            (new CustomerContactsUpdateRequest())->rules(),
            (new CustomerContactsUpdateRequest())->messages());
    }

    public function editContacts(): void
    {
        $this->showSuccessToast(__('Atnaujinta'));
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.customers.profile.customer-profile-contacts-form');
    }
}
