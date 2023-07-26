<?php

namespace App\Http\Requests;

use App\Models\Customer;
use App\Rules\LithuaniaPhoneNumber;
use Illuminate\Foundation\Http\FormRequest;

class CustomerContactsUpdateRequest extends FormRequest
{
    private Customer $customer;

    public function __construct()
    {
        parent::__construct();

        $this->customer = auth('customer')->user();
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'form.participant.first_name' => ['required'],
            'form.participant.last_name' => ['required'],
            'form.participant.phone_number' => ['required', new LithuaniaPhoneNumber()],
        ];

        switch ($this->customer->getType()) {
            case $this->customer->isRenter():
                $renterRules = [
                    'form.renter.first_name' => ['required'],
                    'form.renter.last_name' => ['required'],
                    'form.renter.phone_number' => ['required', new LithuaniaPhoneNumber()],
                    'form.renter.address' => ['required'],
                ];
                $rules = array_merge($rules, $renterRules);
                break;

            case $this->customer->isCompany():
                $companyRules = [
                    'form.company.company_name' => ['required'],
                    'form.company.company_prefix' => ['required'],
                    'form.company.company_first_name' => ['required'],
                    'form.company.company_last_name' => ['required'],
                    'form.company.company_address' => ['required'],
                    'form.company.company_phone' => ['required', new LithuaniaPhoneNumber()],
                    'form.company.company_email' => ['required', 'email'],
                    'form.company.company_bank_name' => ['required'],
                    'form.company.company_bank_iban' => ['required'],
                    'form.company.company_bank_bic_swift_code' => ['required'],
                    'form.company.company_code' => ['required'],
                ];
                $rules = array_merge($rules, $companyRules);
                break;

            default:
                break;
        }

        return $rules;
    }

    public function messages(): array
    {
        $messages = [
            'form.participant.first_name.required' => trans('customer.required'),
            'form.participant.last_name.required' => trans('customer.required'),
            'form.participant.phone_number.required' => trans('customer.required'),
        ];

        switch ($this->customer->getType()) {
            case $this->customer->isRenter():
                $renterMessages = [
                    'form.renter.first_name.required' => trans('customer.required'),
                    'form.renter.last_name.required' => trans('customer.required'),
                    'form.renter.phone_number.required' => trans('customer.required'),
                    'form.renter.address.required' => trans('customer.required'),
                ];
                $messages = array_merge($messages, $renterMessages);
                break;

            case $this->customer->isCompany():
                $companyMessages = [
                    'form.company.company_name.required' => trans('customer.required'),
                    'form.company.company_prefix.required' => trans('customer.required'),
                    'form.company.company_first_name.required' => trans('customer.required'),
                    'form.company.company_last_name.required' => trans('customer.required'),
                    'form.company.company_address.required' => trans('customer.required'),
                    'form.company.company_phone.required' => trans('customer.required'),
                    'form.company.company_email.required' => trans('customer.required'),
                    'form.company.company_email.email' => trans('customer.email'),
                    'form.company.company_bank_name.required' => trans('customer.required'),
                    'form.company.company_bank_iban.required' => trans('customer.required'),
                    'form.company.company_bank_bic_swift_code.required' => trans('customer.required'),
                    'form.company.company_code.required' => trans('customer.required'),
                ];
                $messages = array_merge($messages, $companyMessages);
                break;

            default:
                break;
        }

        return $messages;
    }
}
