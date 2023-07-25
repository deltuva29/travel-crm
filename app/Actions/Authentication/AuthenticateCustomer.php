<?php

namespace App\Actions\Authentication;

use App\Models\Customer;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class AuthenticateCustomer
{
    public function handle($email, $password, $remember): Customer|array|Authenticatable
    {
        if (!Auth::guard('customer')->attempt(['email' => $email, 'password' => $password], $remember)) {
            return ['error' => 'email', 'message' => trans('auth.failed')];
        }

        $customer = Auth::guard('customer')->user();
        if (!$customer || !$customer->isActiveStatus()) {
            Auth::guard('customer')->logout();

            return ['error' => 'email', 'message' => $customer ? trans('auth.activate') : trans('auth.failed')];
        }

        return $customer;
    }
}
