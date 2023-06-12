<?php

namespace App\Nova\Filters\User;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use OptimistDigtal\NovaMultiselectFilter\MultiselectFilter;
use Spatie\Permission\Models\Role;

class MultiRoleFilter extends MultiselectFilter
{
    public function name(): string
    {
        return __('Rolės');
    }

    public function apply(Request $request, $query, $value): Builder
    {
        if (count($value) > 0) {
            return $query->whereIn('id', $value);
        }
        return $query;
    }

    public function options(Request $request): array|callable
    {
        return Role::all()
            ->pluck('name', 'id')
            ->toArray();
    }
}
