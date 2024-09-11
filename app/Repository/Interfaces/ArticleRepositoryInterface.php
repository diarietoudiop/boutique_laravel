<?php

namespace App\Repository\Interfaces;

interface ArticleRepositoryInterface
{

    public function getAllArticles($filtrer = []);

    public function getArticleById(int $id);

    public function createArticle(array $data);

    public function updateArticle(int $id, array $data);

    public function deleteArticle(int $id);

}
