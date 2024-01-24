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
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'firstname' => $this->resource->firstname,
            'lastname' => $this->resource->lastname,
            'birthdate' => $this->resource->birthdate,
            'email' => $this->resource->email,
            $this->mergeWhen(true, [
                'role' => $this->resource->role->role,
            ]),
            /*'role' => $this->resource->role->role,*/
            /*'address' => AddressResource::collection($this->whenloaded('address')),*/
            'address' => $this->resource->address,
        ];
    }
}
