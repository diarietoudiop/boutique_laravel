<?php

namespace App\Services;

use App\Repository\Interfaces\ClientRepositoryInterface;
use App\Exceptions\RepositoryException;
use App\Http\Resources\ClientWithUserResource;

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


    public function findByTelephone(string $telephone)
    {
        try {
            return $this->clientRepository->findByTelephone($telephone);
        } catch (RepositoryException $e) {
            throw $e;
        }
    }

    public function getClientWithDette(int $id)
    {
        return $this->clientRepository->getClientWithDette($id);
    }

    public function getClientsWithDebts()
    {
        return $this->clientRepository->getClientsWithDebts();
    }

    public function getClientWithUser($id)
    {
        $client = $this->clientRepository->getClientWithUser($id);
        return new ClientWithUserResource($client);
    }
}
