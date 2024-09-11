<?php

namespace App\Services;

use App\Repository\Interfaces\DetteRepositoryInterface;

class DetteService
{
    protected $detteRepository;

    public function __construct(DetteRepositoryInterface $detteRepository)
    {
        $this->detteRepository = $detteRepository;
    }

    public function getAllDettes()
    {
        return $this->detteRepository->getAllDettes();
    }

    public function getDetteById(int $id)
    {
        return $this->detteRepository->getDetteById($id);
    }

    public function createDette(array $data)
    {
        // Ajouter de la logique métier ou validation ici
        return $this->detteRepository->createDette($data);
    }

    public function updateDette(int $id, array $data)
    {
        // Ajouter de la logique métier ou validation ici
        return $this->detteRepository->updateDette($id, $data);
    }

    public function deleteDette(int $id)
    {
        // Ajouter de la logique métier ou gestion des erreurs ici
        return $this->detteRepository->deleteDette($id);
    }
}
