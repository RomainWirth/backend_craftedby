<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return AddressResource::collection(Address::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAddressRequest $request): void
    {
        Address::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address): Address
    {
        return $address;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAddressRequest $request, Address $address): void
    {
        $address->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address): void
    {
        $address->delete();
    }
}
