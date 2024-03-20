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
        $specialties = [];
        foreach ($this->specialty as $spec) {
            $specialties = $spec->name;
        }
        return [
            'companyName' => $this->resource->companyName,
            'about' => $this->resource->about,
            'craftingDescription' => $this->resource->craftingDescription,
            'siret' => $this->resource->siret,
            'specialty' => $specialties,
            'theme' => new ThemeResource($this->theme),
            'user' => new UserResource($this->resource->user)
        ];
    }
}
