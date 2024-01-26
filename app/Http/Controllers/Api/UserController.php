<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use http\Env\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return UserResource::collection(User::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): /*UserResource*/ JsonResponse
    {
//        $validatedData = $request->validated();
//        $user = User::create($validatedData);
//        return new UserResource($user);

        $user = new User;
        $validatedData = $request->validated();
        $user->save($validatedData);
        return response()->json([
            "message" => "User created successfully"
        ], 201);
    }

    /**
     * Display the specified resource.
     */
//    public function show(User $user)
//    {
//        $user = User::findOrFail($id);
//
//        $this->authorize('view', $user);
//        return response()->json([
//            'massage' => 'Current user',
//            'user' => $user
//        ]);
//    }

    public function show(string $id): JsonResponse
    {
        $user = UserResource::find($id);
        if(!empty($user)) {
            return response()->json($user);
        } else {
            return response()->json([
                "message" => "User not found"
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $validatedData = $request->validated();
        if(User::where('id', $id)->exists()) {
            $user = User::find($id);
            $user->firstname = is_null($validatedData['firstname']) ? $user->firstname : $validatedData['firstname'];
            //! add fields
            $user->save();
            return response()->json([
                "message" => "User updated successfully"
            ], 201);
        } else {
            return response()->json([
                "message" => "User not found"
            ], 404);
        }
//        if (isset($validatedData['firstname'])) {
//            $user->firstname = $validatedData['firstname'];
//        }
        //! add fields
//        $user->save();
//        return response()->json([
//            'message' => 'User updated successfully',
//            'user' => $user,
//        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id): JsonResponse
    {
        if(User::where('id', $id)->exists()) {
            $user = User::find($id);
            $user->delete();
            return response()->json([
                "message" => "User deleted successfully"
            ], 202);
        } else {
            return response()->json([
                "message" => "User not found"
            ], 404);
        }
//        $user = User::findOrFail($id);
//        $user->delete();
//        return response()->json([
//            'message' => 'User deleted successfully',
//        ]);
    }
}
