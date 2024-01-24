<?php

namespace app\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArtisanRequest;
use App\Http\Requests\UpdateArtisanRequest;
use App\Http\Resources\ArtisanResource;
use App\Models\Artisan;

class ArtisanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return ArtisanResource::collection(Artisan::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArtisanRequest $request): void
    {
        Artisan::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Artisan $artisan): Artisan
    {
        return $artisan;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArtisanRequest $request, Artisan $artisan): void
    {
        $artisan->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artisan $artisan): void
    {
        $artisan->delete();
    }
}
