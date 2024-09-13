<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Services\Interfaces\ArticleServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateStockRequest;



class ArticleController extends Controller
{
    protected $articleService;

    public function __construct(ArticleServiceInterface $articleService)
    {
        $this->articleService = $articleService;
        // $this->authorizeResource(Article::class, 'article');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $this->authorize('viewAny', Article::class);
        $filtres = $request->only(['disponible', 'libelle']);
        return $this->articleService->getAllArticles($filtres);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        // $this->authorize('create', Article::class);

        $validatedData = $request->validated();
        $validatedData['user_id'] = Auth::id(); // Associer l'article au boutiquier connecté
        return $this->articleService->createArticle($validatedData);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        // $this->authorize('view', $article);

        return $this->articleService->getArticleById($article->id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        // $this->authorize('update', $article);

        return $this->articleService->updateArticle($article->id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        // $this->authorize('delete', $article);

        return $this->articleService->deleteArticle($article->id);
    }


    public function updateStock(UpdateStockRequest $request)
    {
        $result = $this->articleService->updateStock($request->validated()['articles']);
        return response()->json($result, 200);
    }



    public function findByTitle(Request $request)
    {
        $request->validate([
            'libelle' => 'required|string'
        ]);
        $article = $this->articleService->findByTitle($request->post("libelle"));

        if ($article) {
            return response()->json($article);
        } else {
            return response()->json(['message' => 'Article non trouvé'], 404);
        }
    }

}
