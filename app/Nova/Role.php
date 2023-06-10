<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Nova;
use Vyuldashev\NovaPermission\PermissionBooleanGroup;
use Vyuldashev\NovaPermission\Role as VyuldashevNovaPermissionRoleResource;

class Role extends VyuldashevNovaPermissionRoleResource
{
    public static function label()
    {
        return __('Rolės');
    }

    public static function singularLabel()
    {
        return __('Rolė');
    }

    public function fields(Request $request): array
    {
        $userResource = Nova::resourceForModel(getModelForGuard($this->guard_name));

        return [
            Text::make(__('Rolės pavadinimas'), 'name')
                ->rules(['required', 'string', 'max:255'])
                ->creationRules('unique:' . config('permission.table_names.roles'))
                ->updateRules('unique:' . config('permission.table_names.roles') . ',name,{{resourceId}}'),

            Text::make(__('Guard'), 'guard_name')->readonly(),

            DateTime::make(__('Sukurta'), 'created_at')->exceptOnForms(),
            DateTime::make(__('Atnaujinta'), 'updated_at')->exceptOnForms(),

            PermissionBooleanGroup::make(__('Leidimai'), 'permissions'),

            MorphToMany::make($userResource::label(), 'users', $userResource)
                ->searchable()
                ->singularLabel($userResource::singularLabel()),
        ];
    }

}
