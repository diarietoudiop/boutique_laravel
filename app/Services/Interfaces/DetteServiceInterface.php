<?php

namespace App\Services\Interfaces;

interface DetteServiceInterface
{

    public function getAllDettes();

    public function getDetteById(int $id);

    public function createDette(array $data);

    public function updateDette(int $id, array $data);

    public function deleteDette(int $id);
}
