<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDetteRequest;
use App\Http\Requests\UpdateDetteRequest;
use App\Models\Dette;
use App\Facades\DetteServiceFacade as DetteFacade;

class DetteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return DetteFacade::getAllDettes();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDetteRequest $request)
    {
        //
        return DetteFacade::createDette($request->validated());

    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        //
        return DetteFacade::getDetteById($id);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDetteRequest $request, int $id)
    {
        //
        return DetteFacade::updateDette($id, $request->validated());

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dette $dette)
    {
        //
    }
}
