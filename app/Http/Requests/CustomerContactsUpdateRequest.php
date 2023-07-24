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
        return [
            'form.participant.first_name' => 'required',
            'form.participant.last_name' => 'required',
            'form.participant.phone_number' => ['required', new LithuaniaPhoneNumber()],
        ];
    }

    public function messages(): array
    {
        return [
            'form.participant.first_name.required' => __('Privalomas laukas'),
            'form.participant.last_name.required' => __('Privalomas laukas'),
            'form.participant.phone_number.required' => __('Privalomas laukas'),
        ];
    }
}
