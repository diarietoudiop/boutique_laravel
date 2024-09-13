<?php

namespace App\Repository;

use App\Models\Dette;
use App\Models\Article;
use App\Models\DetteArticle;
use App\Models\Paiement;

use App\Repository\Interfaces\DetteRepositoryInterface;

class DetteRepository implements DetteRepositoryInterface
{
    public function getAllDettes()
    {
        return Dette::all();
    }

    public function getDetteById(int $id)
    {
        return Dette::find($id);
    }

    public function createDette(array $data)
    {
        return Dette::create($data);
        // dd($data);
    }

    public function updateDette(int $id, array $data)
    {
        $dette = Dette::find($id);
        if ($dette) {
            $dette->update($data);
            return $dette;
        }
        return null;
    }

    public function deleteDette(int $id)
    {
        $dette = Dette::find($id);
        if ($dette) {
            $dette->delete();
            return true;
        }
        return false;
    }


    // public function addArticles(int $detteId, array $articles)
    // {
    //     $detteArticles = [];
    //     foreach ($articles as $article) {
    //         $detteArticles[] = new DetteArticle([
    //             'dette_id' => $detteId,
    //             'article_id' => $article['articleId'],
    //             'quantite' => $article['qteVente'],
    //             'prix_vente' => $article['prixVente']
    //         ]);
    //     }
    //     DetteArticle::insert($detteArticles);
    // }

    // public function updateStock(int $articleId, int $quantity)
    // {
    //     $article = Article::findOrFail($articleId);
    //     $article->quantite -= $quantity;
    //     $article->save();
    // }

    public function addPaiement(int $detteId, float $montant)
    {
        return Paiement::create([
            'dette_id' => $detteId,
            'montant' => $montant
        ]);
    }

    // public function addArticles(Dette $dette, array $articles)
    // {
    //     $articleData = [];
    //     foreach ($articles as $article) {
    //         $articleData[$article['articleId']] = [
    //             'quantite' => $article['qteVente'],
    //             'prix_vente' => $article['prixVente']
    //         ];
    //     }
    //     $dette->articles()->attach($articleData);
    // }

    // public function updateStock(int $articleId, int $quantity)
    // {
    //     $article = Article::findOrFail($articleId);
    //     $article->quantite -= $quantity;
    //     $article->save();
    // }
}
