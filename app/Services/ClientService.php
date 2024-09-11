<?php

namespace App\Services;

use App\Repository\Interfaces\ClientRepositoryInterface;

class ClientService
{
    protected $clientRepository;

    public function __construct(ClientRepositoryInterface $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function getAllClients($compte = null)
    {
        return $this->clientRepository->getAllClients($compte);
    }

    public function getClientById(int $id)
    {
        return $this->clientRepository->getClientById($id);
    }

    public function createClient(array $data)
    {
        // dd($data);
        // Vous pouvez ajouter de la logique métier ici, comme validation
        return $this->clientRepository->createClient($data);
    }

    public function updateClient(int $id, array $data)
    {
        // Vous pouvez ajouter de la logique métier ici, comme validation
        return $this->clientRepository->updateClient($id, $data);
    }

    public function deleteClient(int $id)
    {
        // Vous pouvez ajouter de la logique métier ici, comme gestion des erreurs
        return $this->clientRepository->deleteClient($id);
    }
}
