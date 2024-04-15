<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\Address;
use App\Models\PersonalAccessToken;
use App\Models\Role;
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
    public function index(User $user): ResourceCollection
    {
        $this->authorize('viewAny', $user);
        return UserResource::collection(User::all());
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
        $user = User::find($id);

        $this->authorize('view', $user);

        $user = new UserResource($user);

        return response()->json(['user' => $user], 200);
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
    public function update(Request $request, string $id): JsonResponse
    {
//        dd($request);
        $user = User::find($id);
        $this->authorize('update', $user);
        $dataToUpdate = $request->user;
//        dd($dataToUpdate);
        $address = Address::where('user_id', $id)->first();
//        dd($address);
        $addressToUpdate = $dataToUpdate['address'];
//        dd($addressToUpdate);

        if(User::where('id', $id)->exists()) {
            $user->firstname = is_null($dataToUpdate['firstname']) ? $user->firstname : $dataToUpdate['firstname'];
            $user->lastname = is_null($dataToUpdate['lastname']) ? $user->lastname : $dataToUpdate['lastname'];
            $user->birthdate = is_null($dataToUpdate['birthdate']) ? $user->birthdate : $dataToUpdate['birthdate'];

            if($address->exists()) {
                $address->street = is_null($addressToUpdate['street']) ? $address->street : $addressToUpdate['street'];
                $address->postalCode = is_null($addressToUpdate['postalCode']) ? $address->postalCode : $addressToUpdate['postalCode'];
                $address->city = is_null($addressToUpdate['city']) ? $address->city : $addressToUpdate['city'];
                $address->countryCode = is_null($addressToUpdate['countryCode']) ? $address->countryCode : $addressToUpdate['countryCode'];
            }

            $user->address()->save($address);
            $user->save();

            $user = new UserResource($user);
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
        $this->authorize('delete', $user);

        if ($user->exists()) {
            $user->delete();
            return response()->json([
                'message' => 'User deleted successfully',
            ], 201);
        }
        return response()->json(['message' => 'user not found'], 404);
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
    public function register(StoreUserRequest $request): JsonResponse
    {
        $requestData = $request->all();
        $existingUser = User::where('email', $requestData['email'])->first();
        if(!is_null($existingUser)) {
            return response()->json(['message' => 'User already registered'], 403);
        };
        $user = User::create($requestData);
        $addressData = $request->input('address');
        $user->address()->create($addressData);
        $user->assignRole('user');
        $role = Role::where('name', 'user')->first();

        $token = $user->createToken('Personal Access Token')->plainTextToken;

        return response()->json([
            'token_type' => 'Bearer',
            'accessToken' => $token,
            'user' => $user,
            'role' => $role->name,
            'message' => 'Register successful',
        ], 201);
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

        $email = $credentials['email'];
        $user = User::where('email', $email)->first();
        if(is_null($user)) {
            return response()->json([
                'message' => 'User does not exists'
            ], 404);
        }

        if (!Auth::attempt($credentials)){
            return response()->json([
                'message' => 'Invalid credentials'
            ],401);
        }

        $existingToken = PersonalAccessToken::where('tokenable_id', $user->id);
        if($existingToken->exists()) {
            return response()->json([
                'message' => 'User already logged in'
            ], 403);
        }

        $user = new UserResource($user);

        $token = $user->createToken('Personal Access Token')->plainTextToken;

        return response()->json([
            'token_type' => 'Bearer',
            'accessToken' => $token,
            'user' => $user,
            'message' => 'Login successful',
        ], 200);
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return JsonResponse [string] message
     */
    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);

    }
}
