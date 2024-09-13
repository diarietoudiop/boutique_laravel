<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DetteController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ArticleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/users', [UserController::class, 'store']);


Route::prefix("v1")->group(function () {
    Route::apiResource("articles", ArticleController::class);
    Route::apiResource("clients", ClientController::class);
    Route::apiResource("dettes", DetteController::class);
    Route::post('articles/stock', [ArticleController::class, 'updateStock']);
    Route::post('articles/title', [ArticleController::class, 'findByTitle']);


});


// use App\Http\Controllers\ClientController;

Route::prefix("v1")->group(function () {
    Route::get('/api/clients', [ClientController::class, 'index']);
    Route::get("clients/{id}", [ClientController::class, "show"]);
    Route::get("clients", [ClientController::class, "index"]);
    Route::post("clients/telephone", [ClientController::class, "telephone"]);
    // Route::post("clients/{id}/user", [ClientController::class, "withUser"]);
    Route::get('clients/{id}/user', [ClientController::class, 'showWithUser']);
    Route::get("clients/{id}/dettes", [ClientController::class, "listClientsWithDebts"]);
    Route::post('/clients/tel', [ClientController::class, 'findByTelephone']);
    // Route::get("/clients/dette", [ClientController::class, "listClientsWithDebts"]);

});
