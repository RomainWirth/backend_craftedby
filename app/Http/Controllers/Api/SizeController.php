<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSizeRequest;
use App\Http\Requests\UpdateSizeRequest;
use App\Http\Resources\SizeResource;
use App\Models\Size;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResource
    {
        return SizeResource::collection(Size::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSizeRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $size = Size::create($validatedData);
        return response()->json($size, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSizeRequest $request, Size $size): JsonResponse
    {
        $size->update($request->all());
        return response()->json($size, 201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Size $size): JsonResponse
    {
        $size->delete();
        return response()->json(['message' => 'Size deleted successfully'], 201);
    }
}
