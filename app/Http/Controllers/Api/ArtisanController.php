<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArtisanRequest;
use Illuminate\Http\Request;
use App\Http\Resources\ArtisanResource;
use App\Models\Artisan;
use App\Models\Specialty;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;

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
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $existingArtisan = Artisan::where('id', $id)->first();
        if(is_null($existingArtisan)) {
            return Response()->json([
                'message' => 'Artisan does not exist'
            ], 404);
        }
        $artisan = new ArtisanResource($existingArtisan);
        return response()->json([
            'artisan' => $artisan
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArtisanRequest $request): JsonResponse
    {
//        dd($request);
        $this->authorize('create', Artisan::class);
        $validatedData = $request->validated();
        $existingArtisan = Artisan::where('siret', $validatedData['siret'])->first();
        if (is_null($existingArtisan)) {
            $user = Auth::user();
//            dd($user);
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
        return response()->json([
            'message' => 'Artisan already exists.'
        ], 409); // 409 Conflict
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $artisan = Artisan::where('id', $id)->first();
        $this->authorize('update', $artisan);

//        dd($request);
        $artisan->companyName = is_null($request['companyName']) ? $artisan->companyName : $request['companyName'];
        $artisan->about = is_null($request['about']) ? $artisan->about : $request['about'];
        $artisan->craftingDescription = is_null($request['craftingDescription']) ? $artisan->craftingDescription : $request['craftingDescription'];
        $artisan->siret = is_null($request['siret']) ? $artisan->siret : $request['siret'];

        $specialties = $request->specialty;
        foreach ($specialties as $spec) {
            $specialty = Specialty::where('name', $spec)->first();
            $artisan->specialties()->attach($specialty);
        }

        $artisan->theme = is_null($request['theme']) ? $artisan->theme : $request['theme'];
        $theme = Theme::where('name', $artisan->theme)->first();
//        dd($theme);
        $artisan->theme()->associate($theme->id);

        return response()->json(['artisan' => $artisan]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, $id): JsonResponse
    {
        $artisan = Artisan::where('id', $id)->first();
//        dd($artisan);
        $this->authorize('delete', $artisan);
        $artisan->delete();
        return response()->json(['message' => 'Artisan deleted with success !'], 201);
    }
}
