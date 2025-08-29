<?php

namespace App\Policies;

use App\Models\Salle;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SallePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_salles');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Salle $salle): bool
    {
        return $user->can('view_salles');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_salles');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Salle $salle): bool
    {
        return $user->can('edit_salles');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Salle $salle): bool
    {
        return $user->can('delete_salles');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Salle $salle): bool
    {
        return $user->can('delete_salles');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Salle $salle): bool
    {
        return $user->can('delete_salles');
    }
}