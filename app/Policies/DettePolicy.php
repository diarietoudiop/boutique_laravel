<?php

namespace App\Policies;

use App\Models\Dette;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DettePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Les administrateurs et les boutiquiers peuvent voir toutes les dettes
        return $user->isAdmin() || $user->isBoutiquier();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Dette $dette): bool
    {
        // Les administrateurs et les boutiquiers peuvent voir n'importe quelle dette
        // Les clients peuvent voir leurs propres dettes
        return $user->isAdmin() || $user->isBoutiquier() || $user->id === $dette->client_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Seuls les boutiquiers peuvent créer des dettes
        return $user->isBoutiquier();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Dette $dette): bool
    {
        // Seuls les boutiquiers qui ont créé la dette peuvent la mettre à jour
        return $user->isBoutiquier() && $user->id === $dette->boutiquier_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Dette $dette): bool
    {
        // Seuls les administrateurs peuvent supprimer des dettes
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Dette $dette): bool
    {
        // Seuls les administrateurs peuvent restaurer des dettes supprimées
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Dette $dette): bool
    {
        // Seuls les administrateurs peuvent supprimer définitivement des dettes
        return $user->isAdmin();
    }
}
