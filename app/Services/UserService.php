<?php

namespace App\Services;

use App\Repository\Interfaces\UserRepositoryInterface;
use App\Events\UserRegistered;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Storage;
use App\Exceptions\CustomValidationException;
use App\Facades\LocalStorageFacade;
use App\Services\UploadedFile;




class UserService
{
    protected $userRepository;

    protected const PHOTO_PAR_DEFAUT = "storage/images/avatar.png";

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers()
    {
        return $this->userRepository->getAllUsers();
    }

    public function getUserById(int $id)
    {
        return $this->userRepository->getUserById($id);
    }


    public function createUser(array $data)
    {

        if (isset($data["photo"]))
            $data["photo"] = LocalStorageFacade::uploadFile($data["photo"]);
        else {
            $data["photo"] = self::PHOTO_PAR_DEFAUT;
        }
        return $this->userRepository->createUser($data);
    }




    public function updateUser(int $id, array $data)
    {
        // Ajouter de la logique métier ou validation ici
        return $this->userRepository->updateUser($id, $data);
    }

    public function deleteUser(int $id)
    {
        // Ajouter de la logique métier ou gestion des erreurs ici
        return $this->userRepository->deleteUser($id);
    }

    public function findUserByLogin(string $login)
    {
        return $this->userRepository->findUserByLogin($login);
    }
}
