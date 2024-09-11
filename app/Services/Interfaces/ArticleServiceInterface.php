<?php

namespace App\Services\Interfaces;

interface ArticleServiceInterface
{
    public function getAllArticles($filter = []);
    public function getArticleById(int $id);
    public function createArticle(array $data);
    public function updateArticle(int $id, array $data);
    public function deleteArticle(int $id);
    public function getFilteredArticles(?string $disponible);
}
