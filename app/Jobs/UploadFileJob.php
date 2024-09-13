<?php

namespace App\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use App\Facades\CloudStorageFacade;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UploadFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $user;
    public $tries = 10;


    public function __construct($user)
    {
        $this->user = $user;
    }


    public function handle(): void
    {
        try {
            $path = str_replace("storage", "public", $this->user->photo);
            $localPhotoPath = Storage::path($path);
            $uploadedPhotoUrl = CloudStorageFacade::uploadFile($localPhotoPath);
            $this->user->update(['photo' => $uploadedPhotoUrl]);
        } catch (\Throwable $e) {
            Log::error("Échec du chargement sur Cloudinary pour l'utilisateur {$this->user->id}: " . $e->getMessage());
            $this->release(600); // Faire le relance aprés 10 minutes
        }
    }

    public function failed(Exception $exception)
    {
        Log::error("Job failed after {$this->tries}");
    }
}
