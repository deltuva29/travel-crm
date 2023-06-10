<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('Peržiūrėti vartotojus');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        return $user->hasPermissionTo('Peržiūrėti vartotojus');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('Kurti vartotojus');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        return $user->hasPermissionTo('Redaguoti vartotojus');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        return $user->hasPermissionTo('Ištrinti vartotojus');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function restore(User $user, User $model)
    {
        return $user->hasPermissionTo('Ištrinti vartotojus');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function forceDelete(User $user, User $model)
    {
        return $user->hasPermissionTo('Ištrinti vartotojus');
    }

    /**
     * Determine whether the user can attach the model.
     *
     * @param User $user
     * @param User $model
     * @return bool
     * @throws \Exception
     */
    public function attachAnyClient(User $user, User $model)
    {
        return $user->hasAllPermissions(['Redaguoti vartotojus']);
    }

    /**
     * Determine whether the user can detach the model.
     *
     * @param User $user
     * @param User $model
     * @return bool
     * @throws \Exception
     */
    public function detachClient(User $user, User $model)
    {
        return $user->hasAllPermissions(['Redaguoti vartotojus']);
    }
}
