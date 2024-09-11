<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Article;
use Illuminate\Auth\Access\Response;

class ArticlePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Tous les utilisateurs peuvent voir la liste des articles
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Article $article): bool
    {
        // Tout le monde peut voir un article spécifique
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Seuls les boutiquiers peuvent créer des articles
        return $user->isBoutiquier();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Article $article): bool
    {
        // Les boutiquiers peuvent mettre à jour leurs propres articles
        return $user->isBoutiquier() && $user->id === $article->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Article $article): bool
    {
        // Les boutiquiers peuvent supprimer leurs propres articles
        return $user->isBoutiquier() && $user->id === $article->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Article $article): bool
    {
        // Les boutiquiers peuvent restaurer leurs propres articles supprimés
        return $user->isBoutiquier() && $user->id === $article->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Article $article): bool
    {
        // Seuls les administrateurs peuvent supprimer définitivement un article
        return $user->isAdmin();
    }
}
