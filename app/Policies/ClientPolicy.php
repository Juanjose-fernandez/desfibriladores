<?php

namespace App\Policies;

use App\Client;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any engine manufacturers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->can('client_view');
    }

    /**
     * Determine whether the user can view the engine manufacturer.
     *
     * @param  \App\User  $user
     * @param  \App\Client  $client
     * @return mixed
     */
    public function view(User $user, Client  $client)
    {
        return $user->can('client_view');
    }

    /**
     * Determine whether the user can create engine manufacturers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('client_edit');
    }

    /**
     * Determine whether the user can update the engine manufacturer.
     *
     * @param  \App\User  $user
     * @param  \App\Client  $client
     * @return mixed
     */
    public function update(User $user, Client  $client)
    {
        return $user->can('client_edit');
    }

    /**
     * Determine whether the user can delete the engine manufacturer.
     *
     * @param  \App\User  $user
     * @param  \App\Client  $client
     * @return mixed
     */
    public function delete(User $user, Client  $client)
    {
        return $user->can('client_delete');
    }

    /**
     * Determine whether the user can restore the engine manufacturer.
     *
     * @param  \App\User  $user
     * @param  \App\Client  $client
     * @return mixed
     */
    public function restore(User $user, Client  $client)
    {
        return $user->can('client_delete');
    }

    /**
     * Determine whether the user can permanently delete the engine manufacturer.
     *
     * @param  \App\User  $user
     * @param  \App\EngineManufacturer  $engineManufacturer
     * @return mixed
     */
    public function forceDelete(User $user, Client  $client)
    {
        return $user->can('client_delete');
    }
}
