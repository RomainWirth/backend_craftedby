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
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ArtisanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): ResourceCollection
    {
        return ArtisanResource::collection(Artisan::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArtisanRequest $request): JsonResponse
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

            $user->assignRole('artisan');

            return response()->json($artisan, 201);
        }
        return response()->json(['message' => 'Artisan already exists.'], 409); // 409 Conflict
    }

    /**
     * Display the specified resource.
     */
    public function show(Artisan $artisan): JsonResponse
    {
        return response()->json(['artisan' => $artisan], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArtisanRequest $request, User $user): JsonResponse
    {
        $this->authorize('update', $user);
        $validatedData = $request->validated();
        $artisan->update($validatedData);

        return response()->json(['artisan' => $artisan]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): JsonResponse
    {
        $this->authorize('delete', $user);
        $artisan = Artisan::find('user_id' === $user->id);
        $artisan->delete();
        return response()->json(['message' => 'Artisan deleted with success !'], 201);
    }
}
