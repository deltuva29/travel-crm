<?php

namespace App\Nova;

use App\Enums\CustomerAppealType;
use App\Enums\CustomerCompanyPrefixType;
use App\Enums\CustomerType;
use DigitalCreative\MegaFilter\HasMegaFilterTrait;
use DigitalCreative\MegaFilter\MegaFilter;
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
    use HasMegaFilterTrait;

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
                return isset($this->type) && isset($this->company_prefix) ? $this->getCustomerTypeLabel($this->type, $this->company_prefix) : '-';
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

                Select::make(__('Kreipimasis'), 'appeal_type')
                    ->rules('required', 'in:' . implode(',', CustomerAppealType::values()))
                    ->options(CustomerAppealType::labels())
                    ->onlyOnForms()
                    ->displayUsingLabels(),
            ])->dependsOn('type', CustomerType::RENTER),

            /*
             * CUSTOMER PARTICIPANT FIELDS
             */
            NovaDependencyContainer::make([
                Images::make(__('Nuotrauka'), 'avatar'),

                Text::make(__('Kelionės dalyvio vardas'), 'first_name')
                    ->rules('required', 'max:255')
                    ->sortable(),

                Text::make(__('Kelionės dalyvio pavardė'), 'last_name')
                    ->rules('required', 'max:255')
                    ->sortable(),

                Text::make(__('Kelionės dalyvio el.paštas'), 'email')
                    ->rules('required', 'max:255', 'email')
                    ->sortable(),

                Text::make(__('Kelionės dalyvio telefono numeris'), 'phone')
                    ->rules('required', 'max:15')
                    ->sortable(),

                Text::make(__('Kelionės dalyvio adresas'), 'address')
                    ->hideFromIndex()
                    ->rules('required', 'max:255'),

                Select::make(__('Kreipimasis'), 'appeal_type')
                    ->rules('required', 'in:' . implode(',', CustomerAppealType::values()))
                    ->options(CustomerAppealType::labels())
                    ->onlyOnForms()
                    ->displayUsingLabels(),
            ])->dependsOn('type', CustomerType::PARTICIPANT),

            /*
             * CUSTOMER COMPANY FIELDS
             */
            NovaDependencyContainer::make([
                Text::make(__('Įmonės pavadinimas'), 'company_name')
                    ->rules('required', 'max:255')
                    ->sortable()
                    ->OnlyOnForms(),

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

            Boolean::make(__('Statusas'), 'status')
                ->help(__('Kliento statusas bus "Aktyvuotas" uždėjus varnelę.')),
        ];
    }

    public function cards(Request $request): array
    {
        $filtersMenu = [
            new Filters\Customers\CustomerTypeFilter(),
            new Filters\Customers\CustomerStatusFilter(),
        ];

        return [
            new Metrics\Customers\CountNewCustomers(),
            new Metrics\Customers\CountActiveCustomers(),
            new Metrics\Customers\CountNotActiveCustomers(),

            MegaFilter::make([
                'filters' => $filtersMenu,
                'settings' => [
                    'headerLabel' => __('Meniu'),
                    'filtersLabel' => __('Filtrai'),
                    'actionsLabel' => __('Veiksmai'),
                    'resetLabel' => __('Veiksmai'),
                    'columnsSectionTitle' => __('Papildomos kolonos'),
                    'filtersSectionTitle' => __('Filtrai'),
                    'actionsSectionTitle' => __('Veiksmai'),
                    'columnsResetLinkTitle' => __('Nustatyti standartines kolonas'),
                    'filtersResetLinkTitle' => __('Nustatyti standartines filtrų reikšmes'),
                ],
            ])
        ];
    }
}
