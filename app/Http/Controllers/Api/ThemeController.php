<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $theme = Theme::where('id', $id)->first();
        if($theme->exists()) {
            return response()->json($theme);
        } else {
            return response()->json([
                "message" => "User not found"
            ], 404);
        }
    }
}
