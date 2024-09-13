<?php

namespace App\Observers;

use App\Facades\RoleServiceFacade;
use App\Facades\UserServiceFacade;
use App\Models\Client;
use Illuminate\Support\Facades\Log;

class ClientObserver
{
    /**
     * Handle the Client "created" event.
     */
    public function created(Client $client): void
    {
        //
        Log::info("ClientObserver created");
        $data = request()->all();
        if (isset($data["user"])) {
            Log::info("ClientObserver created client with user");
            $userData = $data["user"];
            $userData["role_id"] = RoleServiceFacade::getRoleIdByName("client"); 

            $user = UserServiceFacade::createUser($userData);
            $user->client()->save($client);
        }
    }

    /**
     * Handle the Client "updated" event.
     */
    public function updated(Client $client): void
    {
        //
    }

    /**
     * Handle the Client "deleted" event.
     */
    public function deleted(Client $client): void
    {
        //
    }

    /**
     * Handle the Client "restored" event.
     */
    public function restored(Client $client): void
    {
        //
    }

    /**
     * Handle the Client "force deleted" event.
     */
    public function forceDeleted(Client $client): void
    {
        //
    }
}
