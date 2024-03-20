<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArtisanRequest;
use App\Http\Requests\UpdateArtisanRequest;
use App\Http\Resources\ArtisanResource;
use App\Models\Artisan;
use App\Models\Specialty;
use App\Models\Theme;
use App\Models\User;

class ArtisanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artisan = ArtisanResource::collection(Artisan::all());
//        dd($artisan);
        return  response()->json($artisan);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArtisanRequest $request)
    {
        $validatedData = $request->validated();
        $existingArtisan = Artisan::where('siret', $validatedData['siret'])->first();
        if (empty($existingArtisan)) {
            $user = User::where('id', $validatedData['user_id'])->first();
            $theme = Theme::where('name', $validatedData['theme'])->first();

            $artisan = new Artisan();
            $artisan->companyName = $validatedData['companyName'];
            $artisan->about = $validatedData['about'];
            $artisan->craftingDescription = $validatedData['craftingDescription'];
            $artisan->siret = $validatedData['siret'];
            $artisan->user()->associate($user);
            $artisan->theme()->associate($theme);
            $artisan->save();

            $specialties = $validatedData['specialty'];
            foreach ($specialties as $spec) {
                $specialty = Specialty::where('name', $spec)->first();
                $artisan->specialties()->attach($specialty);
            }

            return response()->json($artisan, 201);
        }
        return response()->json(['message' => 'Artisan already exists.'], 409); // 409 Conflict
    }

    /**
     * Display the specified resource.
     */
    public function show(Artisan $artisan)
    {
        return response()->json($artisan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArtisanRequest $request, Artisan $artisan)
    {
        $validatedData = $request->validated();
        $artisan->update($validatedData);

        return response()->json($artisan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artisan $artisan)
    {
        $artisan->delete();
        return response()->json(['message' => 'Artisan deleted with success !'], 201);
    }
}
