<?php

namespace App\Repository;

use App\Models\Dette;
use App\Repository\Interfaces\DetteRepositoryInterface;

class DetteRepository implements DetteRepositoryInterface
{
    public function getAllDettes()
    {
        return Dette::all();
    }

    public function getDetteById(int $id)
    {
        return Dette::find($id);
    }

    public function createDette(array $data)
    {
        return Dette::create($data);
    }

    public function updateDette(int $id, array $data)
    {
        $dette = Dette::find($id);
        if ($dette) {
            $dette->update($data);
            return $dette;
        }
        return null;
    }

    public function deleteDette(int $id)
    {
        $dette = Dette::find($id);
        if ($dette) {
            $dette->delete();
            return true;
        }
        return false;
    }
}
