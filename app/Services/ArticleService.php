<?php

namespace App\Services;

use App\Services\Interfaces\ArticleServiceInterface;
use App\Repository\Interfaces\ArticleRepositoryInterface;

class ArticleService implements ArticleServiceInterface
{
    protected $articleRepository;

    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function getAllArticles($filter = [])
    {
        return $this->articleRepository->getAllArticles($filter);
    }

    public function getArticleById(int $id)
    {
        return $this->articleRepository->getArticleById($id);
    }

    public function createArticle(array $data)
    {
        return $this->articleRepository->createArticle($data);
    }

    public function updateArticle(int $id, array $data)
    {
        return $this->articleRepository->updateArticle($id, $data);
    }

    public function deleteArticle(int $id)
    {
        return $this->articleRepository->deleteArticle($id);
    }
    public function getFilteredArticles(?string $disponible)
    {
        $articles = $this->articleRepository->getAllArticles();

        if ($disponible === 'oui') {
            $articles = $articles->where('quantite', '>', 0);
        } elseif ($disponible === 'non') {
            $articles = $articles->where('quantite', '<=', 0);
        }

        return $articles;
    }
}
