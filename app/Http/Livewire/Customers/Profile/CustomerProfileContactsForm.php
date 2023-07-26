<?php

namespace App\Http\Livewire\Customers\Profile;

use App\Http\Requests\CustomerContactsUpdateRequest;
use App\Http\Traits\Customer\WithCustomer;
use App\Http\Traits\Form\WithDisableButton;
use App\Http\Traits\Toast\WithToast;
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

    public function mount(): void
    {
        $this->customer = auth('customer')->user();

        if ($this->customer !== null) {
            $this->initCustomerWithParticipantData();
        }
    }

    protected function initCustomerWithParticipantData(): void
    {
        $this->form['participant']['first_name'] = $this->customer->first_name ?? null;
        $this->form['participant']['last_name'] = $this->customer->last_name ?? null;
        $this->form['participant']['email'] = $this->customer->email ?? null;
        $this->form['participant']['phone_number'] = $this->customer->phone ?? null;
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

    public function editContacts(): void
    {
        $this->validate();

        try {
            $this->updateCustomerParticipant();

            $this->showSuccessToast(__('Atnaujinta'));

        } catch (Exception $ex) {
            session()->flash('error', $ex->getMessage());
        }
    }

    private function updateCustomerParticipant(): void
    {
        $participant = $this->form['participant'];

        $this->customer->update([
            'first_name' => $participant['first_name'] ?? null,
            'last_name' => $participant['last_name'] ?? null,
            'phone' => $participant['phone_number'] ?? null
        ]);
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.customers.profile.customer-profile-contacts-form');
    }
}
