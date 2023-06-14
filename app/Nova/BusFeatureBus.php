<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;

class BusFeatureBus extends Resource
{
    public static string $model = \App\Models\BusFeatureBus::class;

    public static $title = 'id';

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
