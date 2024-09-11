<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DetteCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(function ($dette) {
                $date = is_string($dette->date) ? new \DateTime($dette->date) : $dette->date;
                return [
                    'id' => $dette->id,
                    'date' => $date,
                    'montant' => $dette->montant,
                    'montant_du' => $dette->montantDu,
                    'montant_restant' => $dette->montantRestant,
                    'articles' => $dette->articles->pluck('libelle'),  // Assume "libelle" is the name of the article
                ];
            }),
            'totalRestant' => $this->collection->sum('montantRestant'),
            'total' => $this->collection->sum('montant'),
            'count' => $this->collection->count(),
        ];
    }
}
