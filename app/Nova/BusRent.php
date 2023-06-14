<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;

class BusRent extends Resource
{
    public static string $model = \App\Models\BusRent::class;

    public static $title = 'id';

    public static function label(): string
    {
        return __('Sąrašas nuomojamų autobusų');
    }

    public static function singularLabel(): string
    {
        return __('Autobusas nuomai');
    }

    public static $search = [
        'id',
    ];

    public function fields(Request $request): array
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
        ];
    }
}
