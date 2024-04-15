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
//            dd($category);
            if (!empty($category)) {
                $item->category()->associate($category);
            }

            $size = Size::where('name', $validatedData['size'])->first();
//            dd($size);
            if (!empty($size)) {
                $item->size()->associate($size);
            }

            $color = Color::where('name', $validatedData['color'])->first();
//            dd($color);
            if (!empty($color)) {
                $item->color()->associate($color);
            }

            $artisan_id = Artisan::where('id', $validatedData['artisan_id'])->first();
//            dd($artisan_id);
            if (!empty($artisan_id)) {
                $item->artisan()->associate($artisan_id);
            }
//            dd($item);
            $item->save();
//            dd($item);

            $materials = $validatedData['materials'];
//            dd($materials);
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
    public function show(Item $item): JsonResponse
    {
        return response()->json($item);
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
