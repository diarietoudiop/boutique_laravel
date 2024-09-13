<?php

namespace App\Repository\Interfaces;

interface DetteRepositoryInterface
{

    public function getAllDettes();

    public function getDetteById(int $id);

    public function createDette(array $data);

    public function updateDette(int $id, array $data);

    public function deleteDette(int $id);

    // public function create(array $detteDetails);


    public function addArticles(int $detteId, array $articles);
    public function updateStock(int $articleId, int $quantity);
    // public function addPaiement(int $detteId, float $montant);

}
