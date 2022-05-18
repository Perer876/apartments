<?php

namespace App\Policies;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TenantPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any tenants.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->can('tenants.index');
    }

    /**
     * Determine whether the user can view info about a tenant.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Tenant $tenant)
    {
        return $user->can('tenants.show')
            && $user->id === $tenant->lessor_user_id;
    }

    /**
     * Determine whether the user can create tenants.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('tenants.create');
    }

    /**
     * Determine whether the user can update the tenant.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Tenant $tenant)
    {
        return $user->can('tenants.edit')
            && $user->id === $tenant->lessor_user_id;
    }

    /**
     * Determine whether the user can delete the tenant.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function archive(User $user, Tenant $tenant)
    {
        return $user->can('tenants.archive')
            && $user->id === $tenant->lessor_user_id;
    }

    /**
     * Determine whether the user can delete the tenant.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Tenant $tenant)
    {
        return $user->can('tenants.delete')
            && $user->id === $tenant->lessor_user_id;
    }

    /**
     * Determine whether the user can invite the tenant
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function invite(User $user, Tenant $tenant)
    {
        return $user->can('tenants.invite')
            && $user->id === $tenant->lessor_user_id;
    }
}
