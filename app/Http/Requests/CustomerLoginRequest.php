<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerLoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return false;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => __('El.paštas privalomas'),
            'email.email' => __('El.paštas turi būti galiojantis'),
            'password.required' => __('Slaptažodis privalomas'),
        ];
    }
}
