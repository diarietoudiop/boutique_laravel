<?php

namespace App\Repository\Interfaces;
use App\Enums\CompteStatus;

interface ClientRepositoryInterface
{

    public function getAllClients(?CompteStatus $compte = null);

    public function getClientById(int $id);

    public function createClient(array $data);

    public function updateClient(int $id, array $data);

    public function deleteClient(int $id);

}
