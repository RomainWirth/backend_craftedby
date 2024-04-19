<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Http\Resources\ItemResource;
use App\Models\Artisan;
use App\Models\Category;
use App\Models\Color;
use App\Models\Item;
use App\Models\Material;
use App\Models\Size;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): ResourceCollection
    {
//        dd(Item::all());
//        dd(ItemResource::collection(Item::all()));
        return ItemResource::collection(Item::all());
    }

    /**
     * Store the form for creating a new resource.
     */
    public function store(StoreItemRequest $request): JsonResponse
    {
//        dd('toto');
        $validatedData = $request->validated();
//        dd($validatedData);
        $existingItem = Item::where('name', $validatedData['name'])->first();
//        dd(empty($existingItem));
        if (empty($existingItem)) {

//            $item = Item::create($validatedData);
            $item = new Item();
            $item->name = $validatedData['name'];
            $item->imageUrl = $validatedData['imageUrl'];
            $item->description = $validatedData['description'];
            $item->price = $validatedData['price'];
            $item->stock = $validatedData['stock'];

            $category = Category::where('name', $validatedData['category'])->first();
            if (!empty($category)) {
                $item->category()->associate($category);
            }

            $size = Size::where('name', $validatedData['size'])->first();
            if (!empty($size)) {
                $item->size()->associate($size);
            }

            $color = Color::where('name', $validatedData['color'])->first();
            if (!empty($color)) {
                $item->color()->associate($color);
            }

            $artisan_id = Artisan::where('id', $validatedData['artisan_id'])->first();
            if (!empty($artisan_id)) {
                $item->artisan()->associate($artisan_id);
            }

            $item->save();

            $materials = $validatedData['materials'];
            foreach ($materials as $mat) {
                $material = Material::where('name', $mat)->first();
                $item->materials()->attach($material);
            }

            return response()->json($item, 201);
        }
        return response()->json(['message' => 'Item already exists.'], 409); // 409 Conflict
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $existingItem = Item::where('id', $id)->first();
        if(is_null($existingItem)) {
            return Response()->json([
                'message' => 'Item does not exist'
            ], 404);
        }
        $item = new ItemResource($existingItem);
        return response()->json(['item' => $item], 200);
    }
    /**
     * Display the specified resource.
     */
    public function showArtisanItems(string $artisanId): JsonResponse
    {
        $existingItems = Item::where('artisan_id', $artisanId)->get();
        if(is_null($existingItems)) {
            return Response()->json([
                'message' => 'Item does not exist'
            ], 404);
        }
        $items = ItemResource::collection($existingItems->all());
        return response()->json(['item' => $items], 200);
    }
    /**
     * Display the specified resource.
     */
    public function showCategoryItems(string $categoryId): JsonResponse
    {
        $existingItems = Item::where('category_id', $categoryId)->get();
        if(is_null($existingItems)) {
            return Response()->json([
                'message' => 'Item does not exist'
            ], 404);
        }
        $items = ItemResource::collection($existingItems->all());
        return response()->json(['item' => $items], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item): JsonResponse
    {
        $validatedData = $request->validated();
        $item->update($validatedData);
        return response()->json($item);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item): JsonResponse
    {
        $item->delete();
        return response()->json(['message' => 'item deleted with success!']);
    }
}
