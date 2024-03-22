<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreThemeRequest;
use App\Http\Resources\ThemeResource;
use App\Models\Theme;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): ResourceCollection
    {
        return ThemeResource::collection(Theme::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreThemeRequest $request): JsonResponse
    {
        $requestData = $request->all();
        $existingTheme = Theme::where('name', $requestData['name'])->first();
        if($existingTheme->exists()) {
            return response()->json(['message' => 'Theme already exists.'], 409);
        }
        $theme = Theme::create($requestData);
        return response()->json($theme, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $theme = ThemeResource::find($id);
        if($theme->exists()) {
            return response()->json($theme);
        } else {
            return response()->json([
                "message" => "User not found"
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Theme $theme): JsonResponse
    {
        $theme->delete();
        return response()->json(['message' => 'theme deleted successfully']);
    }
}
