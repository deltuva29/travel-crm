<?php

namespace App\Http\Livewire\Auth\Home;

use App\Actions\Authentication\AuthenticateCustomer;
use App\Http\Requests\CustomerLoginRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Livewire\Component;

class Login extends Component
{
    public ?string $email = null;
    public ?string $password = null;
    public bool $remember = false;

    public function rules(): array
    {
        return (new CustomerLoginRequest())->rules();
    }

    public function messages(): array
    {
        return (new CustomerLoginRequest())->messages();
    }

    public function authenticate(AuthenticateCustomer $authenticateCustomer): Redirector|Application|RedirectResponse
    {
        $this->validate();
        $response = $authenticateCustomer->handle($this->email, $this->password, $this->remember);

        if (isset($response['error'])) {
            $this->addError($response['error'], $response['message']);

            return redirect()->back()->withInput();
        }

        return redirect()->intended(route('customer.dashboard'));
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.auth.home.login');
    }
}
