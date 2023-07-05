<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;

class TripCustomer extends Resource
{
    public static string $model = \App\Models\Trip::class;

    public static $title = 'title';

    public static function label(): string
    {
        return __('Kelionės dalyvis');
    }

    public static function singularLabel(): string
    {
        return __('Kelionės dalyviai');
    }

    public static $search = [
        'id', 'title', 'trip_id', 'customer_id',
    ];

    public function fields(Request $request): array
    {
        return [
            Text::make(__('Pavadinimas'), 'title')
                ->rules('required', 'max:255')
                ->sortable(),
        ];
    }

    public function filters(Request $request): array
    {
        return [
            new Filters\Users\UserMultiRoleFilter(),
        ];
    }
}
