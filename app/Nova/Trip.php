<?php

namespace App\Nova;

use Illuminate\Http\Request;

class Trip extends Resource
{
    public static string $model = \App\Models\Trip::class;

    public static $title = 'name';

    public static function label(): string
    {
        return __('Kelionės');
    }

    public static function singularLabel(): string
    {
        return __('Kelionė');
    }

    public function fields(Request $request): array
    {
        return [];
    }
}
