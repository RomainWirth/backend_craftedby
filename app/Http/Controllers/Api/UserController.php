<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\Address;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
        $this->authorize('viewAny', User::class);
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
        $this->authorize('view', User::class);

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
        $this->authorize('edit', User::class);

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
        $this->authorize('delete', User::class);
        $user = User::find($id);
        if ($user->exists()) {
            $user->delete();
            return response()->json([
                'message' => 'User deleted successfully',
            ], 201);
        }
        return response()->json(['message' => 'user not found'], 404);
    }

    /**
     * Login user and create token
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
//        dd($credentials);
        if (!Auth::attempt($credentials)){
            return response()->json([
                'message' => 'Invalid credentials'
            ],401);
        }

        $email = $credentials['email'];
//        dd($email);
        $user = User::where('email', $email)->first();
//        $user = Auth::user();
//        dd($user);
        $user = new UserResource($user);
//        dd($user);

        $tokenResult = $user->createToken('Personal Access Token');
//        dd($tokenResult);
        $token = $tokenResult->plainTextToken;
//        dd($token);

        return response()->json([
            'accessToken' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
            'message' => 'Login successful',
        ], 200);



    }

    /**
     * Logout user (Revoke the token)
     *
     * @param Request $request
     * @return JsonResponse [string] message
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);

    }
}
