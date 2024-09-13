<?php

namespace App\Listeners;


use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;
use App\Events\UserRegistered;
use App\Jobs\SendWelcomeEmailJob;

class SendWelcomeEmail
{
    public function handle(UserRegistered $event)
    {
        // On déclenche le job pour l'envoie d'email
        SendWelcomeEmailJob::dispatch($event->user);
    }
}

