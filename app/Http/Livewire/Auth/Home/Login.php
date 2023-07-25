<?php

namespace App\Http\Livewire\Auth\Home;

use App\Http\Requests\CustomerLoginRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;

    public function rules(): array
    {
        return (new CustomerLoginRequest())->rules();
    }

    public function messages(): array
    {
        return (new CustomerLoginRequest())->messages();
    }

    public function authenticate()
    {
        $this->validate();

        if (!Auth::guard('customer')->attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            $this->addError('email', trans('auth.failed'));
            return;
        }

        $customer = Auth::guard('customer')->user();
        if (!$customer || !$customer->isActiveStatus()) {
            Auth::guard('customer')->logout();

            $this->addError('email', $customer ? trans('auth.activate') : trans('auth.failed'));
            return;
        }

        return redirect()->intended(route('customer.dashboard'));
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.auth.home.login');
    }
}
