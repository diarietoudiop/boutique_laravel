<?php

namespace App\Http\Resources;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'surname' => $this->surname,
            'addrese' => $this->adresse,
            'telephone' => $this->telephone,
            'qrcode' => url($this->qrcode),
            // 'user' => new UserResource($this->whenLoaded('user')),
            'user' => $this->when($this->user_id, function () {
                return [
                    'id' => $this->user->id,
                    'nom' => $this->user->nom,
                    'prenom' => $this->user->prenom,
                    'email' => $this->user->email,
                    // Ajoutez d'autres champs de l'utilisateur si nécessaire
                ];
            }),
        ];
    }
}
