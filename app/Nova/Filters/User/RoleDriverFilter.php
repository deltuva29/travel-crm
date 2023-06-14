<?php

namespace App\Nova\Filters\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use OptimistDigtal\NovaMultiselectFilter\MultiselectFilter;
use Spatie\Permission\Models\Role;

class RoleDriverFilter extends MultiselectFilter
{
    public function name(): string
    {
        return __('Vairuotojai');
    }

    public function apply(Request $request, $query, $value): Builder
    {
        if (count($value) > 0) {
            return $query->whereIn('user_id', $value);
        }
        return $query;
    }

    public function options(Request $request): array|callable
    {
        $roleId = Role::query()->find(3)->id ?? 0;

        return User::withWhereHas('roles', fn($query) => $query->where('id', $roleId))
            ->orderBy('name')
            ->get()
            ->pluck('name', 'id')
            ->toArray();
    }
}
