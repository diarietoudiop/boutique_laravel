<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SendResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next)
{
    $response = $next($request);

    // Code de statut HTTP
    $statusCode = $response->getStatusCode();

    // Vérifier si le contenu est déjà en JSON
    $content = json_decode($response->getContent(), true);

    // Déterminer le message basé sur le code de statut HTTP
    $message = $statusCode >= 400 ? 'An error occurred' : 'Request handled successfully';

    // if ($statusCode >= 400) {
    //     return response()->json([
    //         'status' => 'error',
    //         'message' => $message,
    //         'code' => $statusCode,
    //         'data' => null
    //     ], $statusCode);
    // }

    // Si le contenu est un tableau PHP, utiliser le contenu comme données
    if (json_last_error() === JSON_ERROR_NONE && is_array($content)) {
        $responseData = isset($content['data']) ? $content['data'] : $content;
    } else {
        $responseData = $response->getContent();
    }

    return response()->json([
        'status' => 'success',
        'message' => $message,
        'code' => $statusCode,
        'data' => $responseData
    ]);
}

}



