<?php

namespace App\Policies;

use App\Models\Lista;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ListaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the lista.
     */
    public function view(User $user, Lista $lista): bool
    {
        return $user->id === $lista->user_id;
    }

    /**
     * Determine whether the user can create listas.
     */
    public function create(User $user): bool
    {
        return (bool) $user;
    }

    /**
     * Determine whether the user can update the lista.
     */
    public function update(User $user, Lista $lista): bool
    {
        return $user->id === $lista->user_id;
    }

    /**
     * Determine whether the user can delete the lista.
     */
    public function delete(User $user, Lista $lista): bool
    {
        return $user->id === $lista->user_id;
    }

    /**
     * Determine whether the user can add a film to the lista.
     */
    public function addFilme(User $user, Lista $lista): bool
    {
        return $user->id === $lista->user_id;
    }

    /**
     * Determine whether the user can remove a film from the lista.
     */
    public function removeFilme(User $user, Lista $lista): bool
    {
        return $user->id === $lista->user_id;
    }
}
