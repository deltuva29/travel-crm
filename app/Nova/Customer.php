<?php

namespace App\Nova;

use App\Enums\CustomerCompanyPrefixType;
use App\Enums\CustomerType;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Sixlive\TextCopy\TextCopy;

class Customer extends Resource
{
    public static string $model = \App\Models\Customer::class;

    public static $title = 'full_name';

    public static function label(): string
    {
        return __('Klientai');
    }

    public static function singularLabel(): string
    {
        return __('Klientas');
    }

    public static $search = [
        'id', 'first_name', 'last_name', 'company_name', 'company_prefix', 'email'
    ];

    public function fields(Request $request): array
    {
        return [
            Text::make(__('Klientas'), function () {
                return $this->fullName ?? '';
            })
                ->hideFromDetail()
                ->readonly()
                ->asHtml(),

            Text::make(__('Kliento tipas'), function () {
                return isset($this->type) ? $this->getCustomerTypeLabel($this->type, $this->company_prefix) : '-';
            })
                ->readonly()
                ->asHtml(),

            Text::make(__('Registracijos tipas'), function () {
                return isset($this->type) ? CustomerType::labels()[$this->type] : '-';
            })
                ->exceptOnForms()
                ->hideFromDetail()
                ->hideFromIndex(),

            Select::make(__('Registracijos tipas'), 'type')
                ->rules('required', 'in:' . implode(',', CustomerType::values()))
                ->options(CustomerType::labels())
                ->onlyOnForms()
                ->displayUsingLabels(),

            /*
             * CUSTOMER RENT FIELDS
             */
            NovaDependencyContainer::make([
                Images::make(__('Nuotrauka'), 'avatar'),

                Text::make(__('Nuomotojo vardas'), 'first_name')
                    ->rules('required', 'max:255')
                    ->sortable(),

                Text::make(__('Nuomotojo pavardė'), 'last_name')
                    ->rules('required', 'max:255')
                    ->sortable(),

                Text::make(__('Nuomotojo el.paštas'), 'email')
                    ->rules('required', 'max:255', 'email')
                    ->sortable(),

                Text::make(__('Nuomotojo telefono numeris'), 'phone')
                    ->rules('required', 'max:15')
                    ->sortable(),

                Text::make(__('Nuomotojo adresas'), 'address')
                    ->hideFromIndex()
                    ->rules('required', 'max:255'),
            ])->dependsOn('type', CustomerType::RENTER),

            /*
             * CUSTOMER PASSENGER FIELDS
             */
            NovaDependencyContainer::make([
                Images::make(__('Nuotrauka'), 'avatar'),

                Text::make(__('Keleivio vardas'), 'first_name')
                    ->rules('required', 'max:255')
                    ->sortable(),

                Text::make(__('Keleivio pavardė'), 'last_name')
                    ->rules('required', 'max:255')
                    ->sortable(),

                Text::make(__('Keleivio el.paštas'), 'email')
                    ->rules('required', 'max:255', 'email')
                    ->sortable(),

                Text::make(__('Keleivio telefono numeris'), 'phone')
                    ->rules('required', 'max:15')
                    ->sortable(),

                Text::make(__('Keleivio adresas'), 'address')
                    ->hideFromIndex()
                    ->rules('required', 'max:255'),
            ])->dependsOn('type', CustomerType::PASSENGER),

            /*
             * CUSTOMER COMPANY FIELDS
             */
            NovaDependencyContainer::make([
                Text::make(__('Įmonės pavadinimas'), 'company_name')
                    ->rules('required', 'max:255')
                    ->sortable(),

                Select::make(__(''), 'company_prefix')
                    ->rules('required', 'in:' . implode(',', CustomerCompanyPrefixType::values()))
                    ->options(CustomerCompanyPrefixType::labels())
                    ->OnlyOnForms(),

                Text::make(__('Įmonės vadovo vardas'), 'first_name')
                    ->rules('required', 'max:255')
                    ->sortable(),

                Text::make(__('Įmonės vadovo pavardė'), 'last_name')
                    ->rules('required', 'max:255')
                    ->sortable(),

                Text::make(__('Įmonės adresas'), 'company_address')
                    ->rules('required', 'max:255')
                    ->sortable(),

                Text::make(__('Įmonės el.paštas'), 'company_email')
                    ->rules('required', 'max:255', 'email')
                    ->sortable(),

                Text::make(__('Įmonės telefono numeris'), 'company_phone')
                    ->rules('required', 'max:35')
                    ->sortable(),

                Text::make(__('Įmonės kodas'), 'company_code')
                    ->rules('required', 'max:15')
                    ->sortable(),

                NovaDependencyContainer::make([
                    Text::make(__('Individualios veiklos pažymos numeris'), 'company_code')
                        ->rules('required', 'max:255')
                        ->sortable(),
                ])->dependsOn('company_prefix', CustomerCompanyPrefixType::IV),

                Heading::make(__('Sąskaitos rekvizitai')),

                TextCopy::make(__('Įmonės banko pavadinimas'), 'company_bank_name')
                    ->rules('required', 'max:255')
                    ->sortable(),

                TextCopy::make(__('Įmonės banko sąskaita'), 'company_bank_iban')
                    ->rules('required', 'max:255')
                    ->sortable(),

                TextCopy::make(__('Įmonės SWIFT/BIC kodas'), 'company_bank_bic_swift_code')
                    ->rules('required', 'max:255')
                    ->sortable(),
            ])->dependsOn('type', CustomerType::COMPANY),

            Boolean::make(__('Statusas'), 'status'),
        ];
    }

    public function filters(Request $request): array
    {
        return [
            new Filters\Customers\CustomerTypeFilter(),
            new Filters\Customers\CustomerStatusFilter(),
        ];
    }
}
