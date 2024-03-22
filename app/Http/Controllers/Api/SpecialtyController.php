<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSpecialtyRequest;
use App\Http\Requests\UpdateSpecialtyRequest;
use App\Http\Resources\SpecialtyResource;
use App\Models\Specialty;
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
    public function store(StoreSpecialtyRequest $request)
    {
        $requestData = $request->all();

        $existingSpecialty = Specialty::where('name', $requestData['name'])->first();
        if(empty($existingSpecialty)) {
            $specialty = Specialty::create($requestData);
            return response()->json($specialty, 201);
        }
        return response()->json(['message' => 'Specialty already exists.'], 409);
    }

    /**
     * Display the specified resource.
     */
    public function show(Specialty $specialty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Specialty $specialty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSpecialtyRequest $request, Specialty $specialty)
    {
        $specialty->update($request->all());
        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specialty $specialty)
    {
        $specialty->delete();
        return response()->json(['message' => 'specialty deleted successfully!']);
    }
}
