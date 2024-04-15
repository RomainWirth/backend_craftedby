<?php

namespace App\Http\Resources;

use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Specialty $specialty
 */
class SpecialtyResource extends JsonResource
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
            'specialty' => $this->name,
        ];
    }
}
