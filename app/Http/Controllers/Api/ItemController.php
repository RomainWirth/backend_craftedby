<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $item = Item::all();
        return response()->json($item);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(StoreItemRequest $request)
    {
        $validatedData = $request->validated();
        $item = Item::create($validatedData);
        return response()->json($item, 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        return response()->json($item);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        $validatedData = $request->validated();
        $item->update($validatedData);
        return response()->json($item);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return response()->json(['message' => 'item deleted with success!']);
    }
}
