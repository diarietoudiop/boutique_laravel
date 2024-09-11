<?php

namespace App\Repository\Interfaces;

interface UserRepositoryInterface
{
    public function getAllUsers();

    public function getUserById(int $id);

    public function createUser(array $data);

    public function updateUser(int $id, array $data);

    public function deleteUser(int $id);

    public function findUserByLogin(string $login);
}
