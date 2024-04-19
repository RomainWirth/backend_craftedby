<?php

namespace App\Http\Resources;

use App\Models\Artisan;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Artisan $resource
 */
class ArtisanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'companyName' => $this->companyName,
            'about' => $this->about,
            'craftingDescription' => $this->craftingDescription,
            'siret' => $this->siret,
            'specialties' => SpecialtyResource::collection($this->specialties),
            'theme' => new ThemeResource($this->theme),
            'user' => new UserResource($this->user),
            'items' => ItemResource::collection($this->items)
        ];
    }
}
