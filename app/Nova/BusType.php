<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;

class BusType extends Resource
{
    public static string $model = \App\Models\BusType::class;

    public static $title = 'name';

    public static function label(): string
    {
        return __('Autobusų tipai');
    }

    public static function singularLabel(): string
    {
        return __('Autobuso tipas');
    }

    public static $search = [
        'name',
    ];

    public function fields(Request $request): array
    {
        return [
            Text::make(__('Pavadinimas'), 'name')
                ->rules('required', 'max:255')
                ->sortable(),
        ];
    }

    public static function authorizedToCreate(Request $request): bool
    {
        return false;
    }

    public function authorizedToUpdate(Request $request): bool
    {
        return false;
    }

    public function authorizedToDelete(Request $request): bool
    {
        return false;
    }
}
