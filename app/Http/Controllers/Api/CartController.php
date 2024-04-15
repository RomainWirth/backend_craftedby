<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $carts = CartResource::collection(Cart::all());
        if(empty($carts)) {
            return response()->json(['message' => 'No cart found'], 404);
        }
        return response()->json(['carts' => $carts], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCartRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $cart = Cart::create($validatedData->safe()->except('items'));
        $items = $validatedData->input('items');
        foreach($items as $item) {
            $itemId = $item['id'];
            $quantity = $item['quantity'];
            $cart->items()->attach($itemId, ['quantity' => $quantity]);
        }

        $cart = CartResource::make($cart);

        return response()->json($cart, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $cart = Cart::find($id);
        if($cart->exists()) {
            $cartResource = CartResource::make($cart);

            return response()->json(['cart' => $cartResource]);
        }
        return response()->json(['message' => 'Cart not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request, $id): JsonResponse
    {
        $validatedData = $request->validated();
        $cart = Cart::find($id);
        $cart->update($validatedData->safe()->except('items'));
        $items = $validatedData->input('items');
        foreach($items as $item) {
            $itemId = $item['id'];
            $quantity = $item['quantity'];
            $cart->items()->attach($itemId, ['quantity' => $quantity]);
        }

        $cart->save();
        $cart = CartResource::make($cart);

        return response()->json($cart);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Cart $cart): JsonResponse
    {


        $cart = Cart::find($id);
        $cart->delete();
        $carts = CartResource::collection(Cart::all());
        return response()->json([
            'message' => 'Cart deleted successfully',
            'carts' => $carts
        ]);
    }
}
