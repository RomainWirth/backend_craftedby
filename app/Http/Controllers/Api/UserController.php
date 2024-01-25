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
    public function store(StoreUserRequest $request): UserResource
    {
//        dd($request);
        $validatedData = $request->validated();
//        dd($validatedData);
        $user = User::create($validatedData);
//        dd($user);
        return new UserResource($user);

        /*$user = new User();
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->birthdate = $request->input('birthdate');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();*/
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);

        $this->authorize('view', $user);
        return response()->json([
            'massage' => 'Current user',
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        $this->authorize('view', $user);

        $validatedData= $request->validated();
        if (isset($validatedData['firstname'])) {
            $user->firstname = $validatedData['firstname'];
        }
        //! add fields



        $user->save();
        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json([
            'message' => 'User deleted successfully',
        ]);
    }
}
