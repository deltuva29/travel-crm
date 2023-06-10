<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Vyuldashev\NovaPermission\PermissionBooleanGroup;
use Vyuldashev\NovaPermission\RoleBooleanGroup;

class User extends Resource
{
    public static string $model = \App\Models\User::class;

    public static $title = 'name';

    public static function label(): string
    {
        return __('Vartotojai');
    }

    public static function singularLabel(): string
    {
        return __('Vartotojas');
    }

    public static $search = [
        'id', 'name', 'email',
    ];

    public function fields(Request $request): array
    {
        return [
            Gravatar::make()->maxWidth(50),

            Text::make(__('Vardas'), 'name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make(__('El.paštas'), 'email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Password::make(__('Slaptažodis'), 'password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),

            RoleBooleanGroup::make('Rolės', 'roles'),

            PermissionBooleanGroup::make('Leidimai', 'Permissions')
                ->showOnIndex(false),
        ];
    }
}
