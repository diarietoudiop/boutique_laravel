<?php

namespace App\Services\Interfaces;

use App\Models\Article;


interface ArticleServiceInterface
{
    public function getAllArticles($filter = []);
    public function getArticleById(int $id);
    public function createArticle(array $data);
    public function updateArticle(int $id, array $data);
    public function deleteArticle(int $id);
    public function getFilteredArticles(?string $disponible);
    public function updateStock(array $articles): array;
    public function findByTitle(string $title): ?Article;
}
