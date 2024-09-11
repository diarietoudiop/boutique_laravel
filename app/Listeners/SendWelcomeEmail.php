<?php

namespace App\Listeners;


use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;
use App\Events\UserRegistered;


class SendWelcomeEmail
{
    public function handle(UserRegistered $event)
    {
        // Envoyer l'email de bienvenue à l'utilisateur
        Mail::to($event->user->email)->send(new WelcomeEmail($event->user));
    }
}

