<?php

namespace App\Repository\Interfaces;
use App\Enums\CompteStatus;
use App\Models\Client;
interface ClientRepositoryInterface
{

    public function getAllClients(?CompteStatus $compte = null);

    public function getClientById(int $id);

    public function createClient(array $data);

    public function updateClient(int $id, array $data);

    public function deleteClient(int $id);

    public function findByTelephone(string $telephone): Client;

    public function getClientWithDette(int $id);

    public function getClientsWithDebts();

    public function getClientWithUser(int $id);

}
