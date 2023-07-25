<?php

namespace App\Http\Livewire\Customers\Profile;

use App\Actions\Settings\RemoveCustomerAvatar;
use App\Actions\Settings\UpdateCustomerAvatar;
use App\Http\Requests\CustomerAvatarUpdateRequest;
use App\Http\Traits\ContentLoader\WithContentLoader;
use App\Http\Traits\Customer\WithCustomer;
use App\Http\Traits\Toast\WithToast;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;

class CustomerProfilePage extends Component
{
    use WithToast,
        WithCustomer,
        WithFileUploads,
        WithContentLoader;

    public $avatar;

    protected $listeners = ['avatarRemoved' => '$refresh'];

    public function rules(): array
    {
        return (new CustomerAvatarUpdateRequest())
            ->rules();
    }

    public function updatedAvatar(): void
    {
        $this->validate();

        try {
            if ($this->avatar) {
                $action = app()->make(UpdateCustomerAvatar::class);
                $updated = $action->execute($this->customer, $this->avatar);

                if ($updated) {
                    $this->loaded = true;
                    $this->resetFields();
                    $this->showSuccessToast(trans('customer.success'));
                }
                $this->resetFields();
            }

        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function removeAvatar(RemoveCustomerAvatar $action): void
    {
        try {
            $removed = $action->execute($this->customer);

            if ($removed) {
                $this->showSuccessToast(trans('customer.success'));

                $this->loaded = true;
                $this->emit('avatarRemoved');
            }
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function resetFields(): void
    {
        $this->reset(['avatar']);
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.customers.profile.customer-profile-page');
    }
}
