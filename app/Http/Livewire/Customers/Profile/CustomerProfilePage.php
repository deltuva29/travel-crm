<?php

namespace App\Http\Livewire\Customers\Profile;

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
                $fileName = strtolower(str_replace(['#', '/', '\\', ' '], '-', $this->avatar->getFilename()));
                $this->customer->clearMediaCollection('avatar');
                $sanitizeFileName = fn($fileName) => strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));

                $this->customer->addMediaFromStream($this->avatar->get())
                    ->sanitizingFileName($sanitizeFileName)
                    ->usingFileName($fileName)
                    ->toMediaCollection('avatar', 'customer_avatars');

                $this->loaded = true;

                $this->resetFields();
                $this->showSuccessToast(__('Atnaujinta'));
            }

        } catch (Exception $e) {
            //Log::error($e->getMessage());
        }
    }

    public function removeAvatar(): void
    {
        try {
            $this->customer->clearMediaCollection('avatar');
            $this->showSuccessToast(__('Atnaujinta'));

            $this->loaded = true;
            $this->emit('avatarRemoved');

        } catch (Exception $e) {
            // Log::error($e->getMessage());
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
