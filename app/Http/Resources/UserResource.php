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
        return [
            'id' => $this->resource->id,
            'firstname' => $this->resource->firstname,
            'lastname' => $this->resource->lastname,
            'birthdate' => $this->resource->birthdate,
            'email' => $this->resource->email,
            'address' => new AddressResource($this->address),
//            $this->mergeWhen($request->user, [
//                'role' => new RoleResource($this->resource->role->id),
//                'address' => new AddressResource($this->resource->address),
//            ]),
        ];
    }
}
