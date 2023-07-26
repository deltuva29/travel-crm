<?php

namespace App\Http\Requests;

use App\Rules\LithuaniaPhoneNumber;
use Illuminate\Foundation\Http\FormRequest;

class CustomerContactsUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'form.participant.first_name' => 'required',
            'form.participant.last_name' => 'required',
            'form.participant.phone_number' => ['required', new LithuaniaPhoneNumber()],
        ];
        if (auth('customer')->user()->isRenter()) {
            $rules = [
                'form.renter.first_name' => 'required',
                'form.renter.last_name' => 'required',
                'form.renter.phone_number' => ['required', new LithuaniaPhoneNumber()],
                'form.renter.address' => 'required',
            ];
        }

        return $rules;
    }

    public function messages(): array
    {
        $messages = [
            'form.participant.first_name.required' => __('Privalomas laukas'),
            'form.participant.last_name.required' => __('Privalomas laukas'),
            'form.participant.phone_number.required' => __('Privalomas laukas'),
        ];
        if (auth('customer')->user()->isRenter()) {
            $messages = [
                'form.renter.first_name.required' => __('Privalomas laukas'),
                'form.renter.last_name.required' => __('Privalomas laukas'),
                'form.renter.phone_number.required' => __('Privalomas laukas'),
                'form.renter.address.required' => __('Privalomas laukas'),
            ];
        }

        return $messages;
    }
}
