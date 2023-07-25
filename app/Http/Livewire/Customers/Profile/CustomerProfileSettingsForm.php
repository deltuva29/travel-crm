<?php

namespace App\Http\Livewire\Customers\Profile;

use App\Actions\Settings\UpdateCustomerPassword;
use App\Http\Requests\CustomerPasswordUpdateRequest;
use App\Http\Traits\Customer\WithCustomer;
use App\Http\Traits\Toast\WithToast;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Livewire\Component;

class CustomerProfileSettingsForm extends Component
{
    use WithToast,
        WithCustomer;

    public ?string $current_password = null;
    public ?string $password = null;
    public ?string $password_confirmation = null;
    public bool $updatePassword = false;
    public bool $isDisabled = true;

    public function updated($fields): void
    {
        $this->checkForPasswordFieldsEmptiness();
        $this->validateOnly($fields);
    }

    private function checkForPasswordFieldsEmptiness(): bool
    {
        $isEmpty = empty($this->current_password) || empty($this->password) || empty($this->password_confirmation);
        $this->isDisabled = $isEmpty;

        return !$isEmpty;
    }

    public function rules(): array
    {
        return (new CustomerPasswordUpdateRequest())
            ->rules();
    }

    public function updateSettings(UpdateCustomerPassword $action): void
    {
        $this->validate();

        try {
            $updated = $action->execute($this->current_password, $this->customer, $this->password);

            if ($updated) {
                $this->updatePassword = true;
                $this->showSuccessToast(trans('settings.success'));
            } else {
                $this->showErrorToast(trans('settings.failed'));
            }
            $this->resetFields();

        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function redirectAfterFiveSeconds(): Redirector|Application|RedirectResponse
    {
        auth('customer')->logout();

        return redirect()->route('home');
    }

    public function resetFields(): void
    {
        $this->reset([
            'current_password',
            'password',
            'password_confirmation'
        ]);

        $this->isDisabled = true;
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.customers.profile.customer-profile-settings-form');
    }
}
