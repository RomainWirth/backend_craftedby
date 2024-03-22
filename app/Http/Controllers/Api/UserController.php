<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\Address;
use http\Env\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @OA\Get(
     *      path="/users",
     *      summary="Get a list of users",
     *      tags={"Users"},
     *      @OA\Response(response=200, description="Successful operation"),
     *      @OA\Response(response=400, description="Invalid request")
     *  )
     */
    public function index(): ResourceCollection
    {
        return UserResource::collection(User::all());
    }

    /**
     * Store a newly created resource in storage.
     * @OA\Post(
     *       path="/users",
     *       summary="Store a new user",
     *       tags={"Users"},
     *       @OA\Response(response=201, description="Successful operation"),
     *       @OA\Response(response=409, description="User already exists")
     *   )
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        $requestData = $request->all();

        $existingUser = User::where('email', $requestData['email'])->first();
        if ($existingUser->exists()) {
            return response()->json(['message' => 'User already exists.'], 409);
        }
        $user = User::create($requestData);
        $addressData = $request->input('address');
        $user->address()->create($addressData);
        return response()->json($user, 201);
    }

     /**
     * Display the specified resource.
      * @OA\Get(
      *       path="/users/{user}",
      *       summary="Get a specific user",
      *       tags={"Users"},
      *       @OA\Response(response=200, description="Successful operation"),
      *       @OA\Response(response=400, description="Invalid request")
      *       @OA\Response(response=404, description="Not found")
      *   )
     */
    public function show($id): JsonResponse
    {
        $existingUser = User::find($id)->first();
        if($existingUser->exists()) {
            $user = new UserResource($existingUser);
            return response()->json($user);
        } else {
            return response()->json([
                "message" => "User not found"
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     * @OA\Put(
     *        path="/users/{id}",
     *        summary="Update a user",
     *        tags={"Users"},
     *        @OA\Response(response=201, description="Successful operation"),
     *        @OA\Response(response=400, description="Invalid request")
     *        @OA\Response(response=404, description="User not found")
     *    )
     */
    public function update(UpdateUserRequest $request, $id): JsonResponse
    {
        $validatedData = $request->validated();
        if(User::where('id', $id)->exists()) {
            $user = User::find($id);
            $user->firstname = is_null($validatedData['firstname']) ? $user->firstname : $validatedData['firstname'];
            $user->lastname = is_null($validatedData['lastname']) ? $user->lastname : $validatedData['lastname'];
            $user->birthdate = is_null($validatedData['birthdate']) ? $user->birthdate : $validatedData['birthdate'];
            $user->password = is_null($validatedData['password']) ? $user->password : $validatedData['password'];
            //! add fields
            $user->save();
            return response()->json([
                'user' => $user,
                "message" => "User updated successfully"
            ], 201);
        } else {
            return response()->json([
                "message" => "User not found"
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @OA\Del(
     *         path="/users/{id}",
     *         summary="Remove a user",
     *         tags={"Users"},
     *         @OA\Response(response=201, description="Successful operation"),
     *         @OA\Response(response=400, description="Invalid request")
     *         @OA\Response(response=404, description="User not found")
     *     )
     */
    public function destroy($id): JsonResponse
    {
        $user = User::find($id);
        if ($user->exists()) {
            $user->delete();
            return response()->json([
                'message' => 'User deleted successfully',
            ], 201);
        }
        return response()->json(['message' => 'user not found'], 404);
    }
}
