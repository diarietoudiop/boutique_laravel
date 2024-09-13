<?php

namespace App\Services\Interfaces;

interface ClientServiceInterface
{
    public function getAllClients();

    public function getClientById(int $id);

    public function createClient(array $data);

    public function updateClient(int $id, array $data);

    public function deleteClient(int $id);

    public function getClientWithDette();

    public function getClientsWithDebts();

    public function getClientWithUser($id);
}
