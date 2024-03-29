<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSpecialtyRequest;
use App\Http\Requests\UpdateSpecialtyRequest;
use App\Http\Resources\SpecialtyResource;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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
        // to check if user is authorized :
        // $this refers to 'Gate::'
        // use method 'authorize' with 2 parameters :
        // 1. the name of the method in the policy file as the ability
        // 2. the model you refer to as the argument
        $this->authorize('create', Specialty::class);

        $requestData = $request->all();
        $existingSpecialty = Specialty::where('name', $requestData['name'])->first();

        if(is_null($existingSpecialty)) {
            $specialty = Specialty::create($requestData);
            return Response()->json([
                'message' => 'specialty created successfully',
                'specialty' => $specialty,
            ], 201);
        }

        return Response()->json([
            'message' => 'specialty already exists',
        ], 409);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $specialty = Specialty::where('id', $id)->first();
        if($specialty->exists()) {
            return response()->json($specialty);
        } else {
            return response()->json([
                "message" => "Specialty not found"
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreSpecialtyRequest $request, $id): JsonResponse
    {
        $this->authorize('update', Specialty::class);

        $dataToUpdate = $request->all();
        $specialty = Specialty::where('id', $id)->first();
        $specialty->name = is_null($dataToUpdate['name']) ? $specialty->name : $dataToUpdate['name'];
        $specialty->save();

        return response()->json([
            'message' => 'specialty updated successfully',
            'specialty' => $specialty,
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $this->authorize('delete', Specialty::class);
        $specialty = Specialty::where('id', $id)->first();
        $specialty->delete();
        return response()->json(['message' => 'specialty deleted successfully!'], 201);
    }
}
