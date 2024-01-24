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
            'companyName' => $this->resource->companyName,
            'about' => $this->resource->about,
            'craftingDescription' => $this->resource->craftingDescription,
            'siret' => $this->resource->siret,
            'specialty' => SpecialtyResource::collection($this->resource->specialties),
            'theme' => $this->resource->theme->name,
        ];
    }
}
