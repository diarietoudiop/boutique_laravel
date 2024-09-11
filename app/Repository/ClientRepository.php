<?php

namespace App\Repository;

use App\Models\Client;
use App\Repository\Interfaces\ClientRepositoryInterface;
use App\Exceptions\RepositoryException;
use App\Enums\CompteStatus;

class ClientRepository implements ClientRepositoryInterface
{

    public function getAllClients(?CompteStatus $compte = null)
    {
        $query = Client::query();
        if ($compte !== null) {
            $query->aCompte($compte);
        }
        return $query->get();
    }

    public function getClientById(int $id)
    {
        return Client::find($id);
    }

    public function createClient(array $data)
{
    try {
        $client = Client::create($data);

        // L'Observer se chargera de créer l'utilisateur si nécessaire

        return $client;
    } catch (\Exception $e) {
        throw new RepositoryException("Une erreur est survenue lors de la création du client : " . $e->getMessage(), 500, $e);
    }
}

    public function updateClient(int $id, array $data)
    {
        $client = Client::find($id);
        if ($client) {
            $client->update($data);
            return $client;
        }
        return null;
    }

    public function deleteClient(int $id)
    {
        $client = Client::find($id);
        if ($client) {
            $client->delete();
            return true;
        }
        return false;
    }
}
