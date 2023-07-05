<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;

class TripCustomer extends Resource
{
    public static string $model = \App\Models\Customer::class;

    public static $title = 'full_name';

    public static function label(): string
    {
        return __('Dalyviai');
    }

    public static function singularLabel(): string
    {
        return __('Naują dalyvį');
    }

    public static $search = [
        'id', 'full_name',
    ];

    public function fields(Request $request): array
    {
        return [
            Text::make(__('Dalyvis'), function () {
                return $this->fullName ?? '';
            })
                ->hideFromDetail()
                ->readonly()
                ->asHtml(),
        ];
    }

    public function filters(Request $request): array
    {
        return [
            new Filters\Users\UserMultiRoleFilter(),
        ];
    }
}
