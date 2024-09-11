<?php

namespace App\Observers;

use App\Models\Client;
use App\Models\User;

class ClientObserver
{
    /**
     * Handle the Client "creating" event.
     *
     * @param  \App\Models\Client  $client
     * @return void
     */
    // public function creating(Client $client)
    // {
    //     if (request()->has('user')) {
    //         // dd("this is a test ");
    //         $userData = request()->input('user');
    //         $user = User::create($userData);
    //         $client->user_id = $user->id;
    //     }
    // }

    public function creating(Client $client)
    {
        if (request()->has('user')) {
            $userData = request()->input('user');

            // Vérifier si l'utilisateur existe déjà
            $existingUser = User::where('email', $userData['email'])->first();

            if ($existingUser) {
                // Si l'utilisateur existe, associez-le simplement au client
                $client->user_id = $existingUser->id;
            } else {
                // Si l'utilisateur n'existe pas, créez-en un nouveau
                $userData['role_id'] = 3;

                if (!isset($userData['password'])) {
                    $userData['password'] = bcrypt('password_temporaire');
                }

                // Générer un email unique si nécessaire
                $baseEmail = $userData['email'];
                $counter = 1;
                while (User::where('email', $userData['email'])->exists()) {
                    $userData['email'] = $baseEmail . '_' . $counter++;
                }

                $user = User::create($userData);
                $client->user_id = $user->id;
            }
        }
    }
}
