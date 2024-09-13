<?php

namespace App\Repository\Interfaces;

use App\Models\Article;

interface ArticleRepositoryInterface
{

    public function getAllArticles($filtrer = []);

    public function getArticleById(int $id);

    public function createArticle(array $data);

    public function updateArticle(int $id, array $data);

    public function deleteArticle(int $id);

    public function updateQuantity(Article $article, int $quantity): void;

    public function find(int $id): ?Article;
    
    public function findByTitle(string $title): ?Article;

}
