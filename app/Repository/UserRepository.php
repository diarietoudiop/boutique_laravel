<?php

namespace App\Repository;

use App\Models\User;
use App\Repository\Interfaces\UserRepositoryInterface;
use App\Exceptions\RepositoryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUsers()
    {
        return User::all();
    }

    public function getUserById(int $id)
    {
        return User::find($id);
    }

    public function createUser(array $data)
    {
        return User::create($data);
    }

    // public function updateUser(int $id, array $data)
    // {
    //     $user = User::find($id);
    //     if ($user) {
    //         $user->update($data);
    //         return $user;
    //     }
    //     return null;
    // }

    public function updateUser(int $id, array $data)
    {
        try {
            $user = User::findOrFail($id);
            $user->update($data);
            return $user;
        } catch (ModelNotFoundException $e) {
            throw new RepositoryException("L'utilisateur avec l'ID $id n'a pas été trouvé.", 404, $e);
        } catch (\Exception $e) {
            throw new RepositoryException("Une erreur est survenue lors de la mise à jour de l'utilisateur : " . $e->getMessage(), 500, $e);
        }
    }
    
    public function deleteUser(int $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return true;
        }
        return false;
    }

    public function findUserByLogin(string $login)
    {
        return User::where('email', $login)->first();
    }
}
