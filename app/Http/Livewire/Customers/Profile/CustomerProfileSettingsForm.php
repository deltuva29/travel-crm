<?php

namespace App\Http\Livewire\Customers\Profile;

use App\Http\Requests\CustomerPasswordUpdateRequest;
use App\Http\Traits\Customer\WithCustomer;
use App\Http\Traits\Toast\WithToast;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;
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
        $this->checkForFieldEmptiness();
        $this->validateOnly($fields);
    }

    private function checkForFieldEmptiness(): bool
    {
        if (empty($this->current_password) || empty($this->password) || empty($this->password_confirmation)) {
            $this->isDisabled = true;
            return false;
        } else {
            $this->isDisabled = false;
            return true;
        }
    }

    public function rules(): array
    {
        return (new CustomerPasswordUpdateRequest())
            ->rules();
    }

    public function updateSettings(): void
    {
        try {
            $this->validate();

            if (!Hash::check($this->current_password, $this->customer->password ?? '')) {
                $this->showErrorToast(__('Blogas slaptažodis'));
                return;
            }
            $this->customer->update([
                'password' => Hash::make($this->password),
            ]);
            $this->updatePassword = true;
            $this->showSuccessToast(__('Išsaugota'));

            $this->resetFields();

        } catch (Exception $e) {
            //Log::error($e->getMessage());
            $this->resetFields();
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
