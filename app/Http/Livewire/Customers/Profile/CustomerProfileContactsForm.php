<?php

namespace App\Http\Livewire\Customers\Profile;

use App\Actions\Settings\UpdateCustomerContacts;
use App\Http\Requests\CustomerContactsUpdateRequest;
use App\Http\Traits\Customer\WithCustomer;
use App\Http\Traits\Form\WithDisableButton;
use App\Http\Traits\Toast\WithToast;
use App\Services\CustomerService;
use Exception;
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

    public function mount(CustomerService $customerService): void
    {
        $this->customer = auth('customer')->user();

        if ($this->customer !== null) {
            $this->initCustomerData($customerService);
        }
    }

    protected function initCustomerData($customerService): void
    {
        $participantData = $customerService->initCustomerData('participant', $this->customer);
        $renterData = $customerService->initCustomerData('renter', $this->customer);

        $this->form = array_merge(
            is_array($this->form) ? $this->form : [],
            is_array($participantData) ? $participantData : [],
            is_array($renterData) ? $renterData : []
        );
    }

    public function updated($fields): void
    {
        $this->checkForFieldEmptiness();

        $this->validateOnly($fields);
    }

    public function rules(): array
    {
        return (new CustomerContactsUpdateRequest())->rules();
    }

    public function messages(): array
    {
        return (new CustomerContactsUpdateRequest())->messages();
    }

    public function editContacts(UpdateCustomerContacts $action): void
    {
        $this->validate();

        try {
            $updated = $action->execute($this->form, $this->customer);

            if ($updated) {
                $this->showSuccessToast(trans('customer.success'));
            }

        } catch (Exception $ex) {
            session()->flash('error', $ex->getMessage());
        }
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.customers.profile.customer-profile-contacts-form');
    }
}
