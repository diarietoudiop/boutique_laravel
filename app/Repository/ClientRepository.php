<?php

namespace App\Repository;

use App\Models\Client;
use App\Repository\Interfaces\ClientRepositoryInterface;
use App\Exceptions\RepositoryException;
use App\Enums\CompteStatus;
use App\Exceptions\ClientNotFoundException;
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


    public function findByTelephone(string $telephone): Client
    {
        $client = Client::where('telephone', $telephone)->first();
        if (!$client) {
            throw new RepositoryException("Aucun client trouvé avec ce numéro de téléphone.");
        }
        return $client;
    }


    public function getClientWithDette(int $id)
    {
        return Client::with('dettes')->findOrFail($id);
    }

    public function getClientsWithDebts()
    {
        return Client::has('dettes')->with('dettes')->paginate();
    }

    public function getClientWithUser(int $id)
    {
        return Client::with('user')->findOrFail($id);
    }
}
