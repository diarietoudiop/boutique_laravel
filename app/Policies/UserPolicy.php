<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Par exemple, seuls les administrateurs peuvent voir tous les utilisateurs
        return $user->isAdmin();
    }


    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        // Les administrateurs peuvent voir n'importe quel utilisateur
        // Les utilisateurs normaux peuvent voir leur propre profil
        return $user->isAdmin() || $user->id === $model->id;
    }


    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Seuls les administrateurs peuvent créer de nouveaux utilisateurs
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     */
    // public function update(User $user, User $model): bool
    // {
    //     //
    // }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
{
    // Les administrateurs peuvent supprimer n'importe quel utilisateur
    // Les utilisateurs normaux ne peuvent pas supprimer de comptes (optionnel)
    return $user->isAdmin();
}

    /**
     * Determine whether the user can restore the model.
     */
    // public function restore(User $user, User $model): bool
    // {
    //     //
    // }

    /**
     * Determine whether the user can permanently delete the model.
     */
    // public function forceDelete(User $user, User $model): bool
    // {
    //     //
    // }
}
