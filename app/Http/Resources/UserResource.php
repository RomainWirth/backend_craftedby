<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property User $resource
 */
class UserResource extends JsonResource
{
    public static $wrap = 'user';
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        dd($request);
        return [
            'id' => $this->id,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'birthdate' => $this->birthdate,
            'email' => $this->email,
            'address' => new AddressResource($this->address),
//            $this->mergeWhen($request->user, [
//                'role' => new RoleResource($this->resource->role->id),
//                'address' => new AddressResource($this->resource->address),
//            ]),
        ];
    }
}
