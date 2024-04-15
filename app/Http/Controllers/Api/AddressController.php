<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     * @SWG\Get(
     *      path="/users/address",
     *      summary="Get a list of users",
     *      tags={"Users"},
     *      @SWG\Response(response=200, description="Successful operation"),
     *      @SWG\Response(response=400, description="Invalid request")
     *  )
     */
    public function index(): ResourceCollection
    {
        return AddressResource::collection(Address::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAddressRequest $request, $userId)
    {
        Address::create(array_merge($request->all(), ['user_id' => $userId]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address): JsonResponse
    {
        return response()->json(['address' => $address], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAddressRequest $request, User $user)/*: JsonResponse*/
    {
//        $this->authorize('update', [$request, $user]);
//
//        $validatedData = $request->validated();
////        $address->update($request->all());
//        $address = Address::find('user_id' === $user->id);
//        if($address->exists()) {
//            $address->street = is_null($validatedData['street']) ? $address->street : $validatedData['street'];
//            $address->postalCode = is_null($validatedData['postalCode']) ? $address->postalCode : $validatedData['postalCode'];
//            $address->city = is_null($validatedData['city']) ? $address->city : $validatedData['city'];
//            $address->countryCode = is_null($validatedData['countryCode']) ? $address->countryCode : $validatedData['countryCode'];
//            $address->save();
//
//            return response()->json([
//                'address' => $address,
//                'message' => 'Address updated successfully'
//            ], 201);
//        }
//        return response()->json(['message' => 'address not found'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): JsonResponse
    {
        $address = Address::find('user_id' === $user->id);
        if($address->exists()) {
            $address->delete();

            return response()->json([
                'message' => 'Address removed successfully'
            ], 201);
        }
        return response()->json(['message' => 'address not found'], 404);
    }
}
