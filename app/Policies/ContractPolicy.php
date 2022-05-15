<?php

namespace App\Policies;

use App\Models\Contract;
use App\Models\Tenant;
use App\Models\Apartment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContractPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any contract that owns.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->can('contracts.index');
    }

    /**
     * Determine whether the user can view a contract info.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Apartment $apartment)
    {
        return $user->can('contracts.show')
            && $user->id === $apartment->building->user_id;
    }

    /**
     * Determine whether the user can create a new contract with a tenant.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user, Tenant $tenant)
    {
        return $user->can('contracts.create')
            && $user->id === $tenant->lessor_user_id
            && ($tenant->lastestContract === null || in_array($tenant->lastestContract->status, ['cancelled', 'finished']));
    }

    /**
     * Determine whether the user can cancel an active or commign contract
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function cancel(User $user, Contract $contract)
    {
        return $user->can('contracts.cancel')
            && $user->id === $contract->user_id
            && in_array($contract->status, ['active', 'coming']);
    }
}
