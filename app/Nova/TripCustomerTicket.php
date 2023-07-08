<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;

class TripCustomerTicket extends Resource
{
    public static string $model = \App\Models\TripCustomerTicket::class;

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

    public static $title = 'code';

    public static function label(): string
    {
        return __('Kelionės bilietai');
    }

    public static function singularLabel(): string
    {
        return __('Kelionės bilietas');
    }

    public static $search = [
        'id', 'code'
    ];

    public function fields(Request $request): array
    {
        return [
            Text::make(__('Bilieto.nr'), 'code')
                ->rules('required', 'max:255')
                ->sortable(),
        ];
    }
}
