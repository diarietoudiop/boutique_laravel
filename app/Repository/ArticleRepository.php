<?php

namespace App\Repository;

use App\Repository\Interfaces\ArticleRepositoryInterface;
use App\Models\Article;

class ArticleRepository implements ArticleRepositoryInterface
{

    public function getAllArticles($filtrer = [])
    {
        $query = Article::query();

        if (isset($filtrer['libelle'])) {
            $query->findByLibelle($filtrer['libelle']);
        }

        if (isset($filtrer['disponible'])) {
            $query->estDisponible($filtrer["disponible"]);
        }

        return $query->get();
    }

    public function getArticleById(int $id)
    {
        return Article::find($id);
    }

    public function createArticle(array $data)
    {
        return Article::create($data);
    }

    public function updateArticle(int $id, array $data)
    {
        $article = Article::find($id);
        if ($article) {
            $article->update($data);
            return $article;
        }
        return null;
    }

    public function deleteArticle(int $id)
    {
        $article = Article::find($id);
        if ($article) {
            $article->delete();
            return true;
        }
        return false;
    }
}
