<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSpecialtyRequest;
use App\Http\Requests\UpdateSpecialtyRequest;
use App\Http\Resources\SpecialtyResource;
use App\Models\Specialty;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SpecialtyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): ResourceCollection
    {
        return SpecialtyResource::collection(Specialty::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSpecialtyRequest $request): JsonResponse
    {
        $requestData = $request->all();
        $existingSpecialty = Specialty::where('name', $requestData['name'])->first();
        if($existingSpecialty->exists()) {
            return response()->json(['message' => 'Specialty already exists.'], 409);
        }

        $specialty = Specialty::create($requestData);
        return response()->json($specialty, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $specialty = SpecialtyResource::find($id);
        if($specialty->exists()) {
            return response()->json($specialty);
        } else {
            return response()->json([
                "message" => "User not found"
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSpecialtyRequest $request, Specialty $specialty): JsonResponse
    {
        $specialty->update($request->all());
        return response()->json($specialty, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specialty $specialty): JsonResponse
    {
        $specialty->delete();
        return response()->json(['message' => 'specialty deleted successfully!']);
    }
}
