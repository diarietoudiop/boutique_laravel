<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Facades\ClientServiceFacade as ClientFacade;
use App\Http\Resources\ClientResource;
use Illuminate\Http\Request;
use App\Enums\CompteStatus;
use Illuminate\Validation\Rule;
use App\Rules\TelephoneRule;
use App\Facades\ClientServiceFacade;
use App\Http\Resources\ClientDetteResource;



class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index(Request $request)
    {
        $validated = $request->validate([
            'compte' => ['nullable', Rule::enum(CompteStatus::class)],
        ]);

        $compteStatus = isset($validated['compte']) ? CompteStatus::from($validated['compte']) : null;
        $clients = ClientFacade::getAllClients($compteStatus);
        return ClientResource::collection($clients);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request)
    {
        //
        return ClientFacade::createClient($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        //
        return ClientFacade::getClientById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, int $id)
    {
        //
        return ClientFacade::updateClient($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //
    }


    public function findByTelephone(Request $request)
    {
        $validated = $request->validate([
            'telephone' => ['required', 'string'], // Ajoutez vos règles de validation ici
        ]);

        try {
            $client = ClientServiceFacade::findByTelephone($validated['telephone']);
            return response()->json([
                'message' => 'Client trouvé avec succès.',
                'data' => new ClientResource($client),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Client non trouvé ou une erreur est survenue.',
            ], 404);
        }
    }

    public function listClientsWithDebts(Request $request)
    {
        // $this->authorize('viewAny', Client::class);

        $perPage = $request->input('per_page', 15); // Nombre d'éléments par page, par défaut 15
        $clients = ClientFacade::getClientsWithDebts();

        return ClientDetteResource::collection($clients);
    }



    public function showWithUser($id)
    {
        try {
            $clientWithUser = ClientFacade::getClientWithUser($id);

            return response()->json([
                'status' => 200,
                'data' => $clientWithUser,
                'message' => 'Client trouvé'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 404,
                'data' => null,
                'message' => 'Objet non trouvé'
            ], 404);
        }
    }
}
