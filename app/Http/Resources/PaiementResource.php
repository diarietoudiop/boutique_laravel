<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaiementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'montant' => $this->montant,
            'date' => $this->date,
            // 'dette_id' => $this->dette_id,
            // 'client_id' => $this->client_id,
            'dette' => $this->whenLoaded("dette"),
            'client' => $this->whenLoaded('client'),
        ];
    }
}
