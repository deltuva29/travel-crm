<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HomeLogin extends Component
{
    /** @var string */
    public $email = '';

    /** @var string */
    public $password = '';

    /** @var bool */
    public $remember = false;

    protected $rules = [
        'email' => ['required', 'email'],
        'password' => ['required'],
    ];

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
        return view('livewire.auth.home-login');
    }
}
