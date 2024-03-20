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
    public function store(StoreUserRequest $request)
    {
        $requestData = $request->all();

        $existingUser = User::where('email', $requestData['email'])->first();
        if (empty($existingUser)) {
            $user = User::create($requestData);
            $addressData = $request->input('address');
            $user->address()->create($addressData);
            return response()->json($user, 201);
        }
        return response()->json(['message' => 'User already exists.'], 409);
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
    public function show(String $id)
    {
        $user = new UserResource(User::find($id));
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
     * @OA\Put(
     *        path="/users/{id}",
     *        summary="Update a user",
     *        tags={"Users"},
     *        @OA\Response(response=201, description="Successful operation"),
     *        @OA\Response(response=400, description="Invalid request")
     *        @OA\Response(response=404, description="User not found")
     *    )
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
                'user' => $user,
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
     * @OA\Del(
     *         path="/users/{id}",
     *         summary="Remove a user",
     *         tags={"Users"},
     *         @OA\Response(response=201, description="Successful operation"),
     *         @OA\Response(response=400, description="Invalid request")
     *         @OA\Response(response=404, description="User not found")
     *     )
     */
    public function destroy(String $id)
    {
//        if(User::where('id', $id)->exists()) {
//            $user = User::find($id);
//            $user->delete();
//            return response()->json([
//                "message" => "User deleted successfully"
//            ], 202);
//        } else {
//            return response()->json([
//                "message" => "User not found"
//            ], 404);
//        }
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json([
            'message' => 'User deleted successfully',
        ]);
    }
}
