<?php

namespace App\Listeners;

use App\Jobs\UploadFileJob;
use App\Events\UserRegistered;

class UploadFileListener
{

    public function handle(UserRegistered $event): void
    {
        // On déclenche le job pour le téléchargement de la photo sur le cloud
        UploadFileJob::dispatch($event->user);
    }
}
