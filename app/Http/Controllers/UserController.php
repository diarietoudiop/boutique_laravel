<?php
namespace App\Http\Controllers;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\JsonResponse;
use App\Facades\UserServiceFacade as UserFacade;

class UserController extends Controller
{
    // protected $userService;

    // public function __construct(UserServiceInterface $userService)
    // {
    //     $this->userService = $userService;
    // }



    public function index(): JsonResponse
    {
        // $this->authorize('viewAny', User::class);
        $users = UserFacade::getAllUsers();
        return response()->json($users);
    }



    public function store(StoreUserRequest $request): JsonResponse
    {
        // $this->authorize('create', User::class);
        $user = UserFacade::createUser($request->validated());
        return response()->json($user, 201);
    }



    public function show(int $id): JsonResponse
    {
        $user = UserFacade::getUserById($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        // $this->authorize('view', $user);
        return response()->json($user);
    }



    public function update(UpdateUserRequest $request, int $id): JsonResponse
    {
        $user = UserFacade::getUserById($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        // $this->authorize('update', $user);
        $updatedUser = UserFacade::updateUser($id, $request->validated());
        return response()->json($updatedUser);
    }




    public function destroy(int $id): JsonResponse
    {
        $user = UserFacade::getUserById($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        // $this->authorize('delete', $user);
        UserFacade::deleteUser($id);
        return response()->json(['message' => 'User deleted successfully']);
    }
}
