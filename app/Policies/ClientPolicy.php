<?php

namespace App\Policies;

use App\Models\Client;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ClientPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Seuls les administrateurs et les boutiquiers peuvent voir la liste des clients
        return $user->isAdmin() || $user->isBoutiquier();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Client $client): bool
    {
        // Les admins et boutiquiers peuvent voir n'importe quel client
        // Les clients ne peuvent voir que leur propre compte
        return $user->isAdmin() || $user->isBoutiquier() || $user->id === $client->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Seuls les administrateurs et les boutiquiers peuvent créer des clients
        return $user->isAdmin() || $user->isBoutiquier();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Client $client): bool
    {
        // Les admins et boutiquiers peuvent mettre à jour n'importe quel client
        // Les clients peuvent mettre à jour leur propre compte
        return $user->isAdmin() || $user->isBoutiquier() || $user->id === $client->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Client $client): bool
    {
        // Seuls les administrateurs peuvent supprimer des clients
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Client $client): bool
    {
        // Seuls les administrateurs peuvent restaurer des clients
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Client $client): bool
    {
        // Seuls les administrateurs peuvent supprimer définitivement des clients
        return $user->isAdmin();
    }
}
