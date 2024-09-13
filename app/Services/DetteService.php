<?php

namespace App\Services;

use App\Models\Article;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Repository\Interfaces\DetteRepositoryInterface;

class DetteService
{
    protected $detteRepository;

    public function __construct(DetteRepositoryInterface $detteRepository)
    {
        $this->detteRepository = $detteRepository;
    }

    public function getAllDettes()
    {
        return $this->detteRepository->getAllDettes();
    }

    public function getDetteById(int $id)
    {
        return $this->detteRepository->getDetteById($id);
    }

    // public function createDette(array $data)
    // {
    //     // Ajouter de la logique métier ou validation ici
    //     return $this->detteRepository->createDette($data);
    // }

    public function updateDette(int $id, array $data)
    {
        // Ajouter de la logique métier ou validation ici
        return $this->detteRepository->updateDette($id, $data);
    }

    public function deleteDette(int $id)
    {
        // Ajouter de la logique métier ou gestion des erreurs ici
        return $this->detteRepository->deleteDette($id);
    }


    public function createDette(array $data)
    {
        DB::beginTransaction();

        try {
            $this->validateDetteData($data);

            $dette = $this->detteRepository->createDette([
                'montant' => $data['montant'],
                'client_id' => $data['clientId']
            ]);

            $totalMontant = 0;

            foreach ($data['articles'] as $articleData) {
                $this->detteRepository->updateStock($articleData['articleId'], $articleData['qteVente']);
                $totalMontant += $articleData['qteVente'] * $articleData['prixVente'];
            }

            if ($totalMontant != $data['montant']) {
                throw new \Exception("Le montant total des articles ne correspond pas au montant de la dette");
            }

            $this->detteRepository->addArticles($dette->id, $data['articles']);

            if (isset($data['paiement']) && $data['paiement']['montant'] > 0) {
                if ($data['paiement']['montant'] > $dette->montant) {
                    throw new \Exception("Le montant du paiement ne peut pas dépasser le montant de la dette");
                }
                $this->detteRepository->addPaiement($dette->id, $data['paiement']['montant']);
            }

            DB::commit();

            $dette->load('articles', 'client');

            return [
                'status' => 201,
                'data' => $dette,
                'message' => 'Dette enregistrée avec succès'
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'status' => 411,
                'data' => ['error' => $e->getMessage()],
                'message' => 'Erreur de validation'
            ];
        }
    }

    private function validateDetteData($data)
    {
        $validator = Validator::make($data, [
            'montant' => 'required|numeric|min:0',
            'clientId' => 'required|exists:clients,id',
            'articles' => 'required|array|min:1',
            'articles.*.articleId' => 'required|exists:articles,id',
            'articles.*.qteVente' => 'required|numeric|min:1',
            'articles.*.prixVente' => 'required|numeric|min:0',
            'paiement.montant' => 'nullable|numeric|min:0|max:' . $data['montant'],
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }

        foreach ($data['articles'] as $article) {
            $stockArticle = Article::find($article['articleId'])->quantite;
            if ($stockArticle < $article['qteVente']) {
                throw new \Exception("Stock insuffisant pour l'article {$article['articleId']}");
            }
        }
    }
}
