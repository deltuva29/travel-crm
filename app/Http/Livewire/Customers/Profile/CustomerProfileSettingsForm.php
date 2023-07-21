<?php

namespace App\Http\Livewire\Customers\Profile;

use App\Http\Requests\CustomerPasswordUpdateRequest;
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
    use WithToast;

    public $current_password;
    public $password;
    public $password_confirmation;
    public $updatePassword = false;
    public $isDisabled = true;

    public function updatedCurrentPassword(): void
    {
        $this->checkForFieldEmptiness();
    }

    public function updatedPassword(): void
    {
        $this->checkForFieldEmptiness();
    }

    public function updatedPasswordConfirmation(): void
    {
        $this->checkForFieldEmptiness();
    }

    private function checkForFieldEmptiness(): void
    {
        if (empty($this->current_password) || empty($this->password) || empty($this->password_confirmation)) {
            $this->isDisabled = true;
        } else {
            $this->isDisabled = false;
        }
    }

    public function rules(): array
    {
        return (new CustomerPasswordUpdateRequest())
            ->rules();
    }

    public function updateSettings(): void
    {
        $user = auth('customer')->user();

        try {
            $this->validate();

            if (!Hash::check($this->current_password, $user->password ?? '')) {
                $this->showErrorToast(__('Blogas slaptažodis'));
                return;
            }
            $user->update([
                'password' => Hash::make($this->password),
            ]);
            $this->updatePassword = true;
            $this->showSuccessToast(__('Išsaugota'));
            $this->resetFields();

        } catch (Exception $e) {
            //Log::error($e->getMessage());
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
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.customers.profile.customer-profile-settings-form');
    }
}
