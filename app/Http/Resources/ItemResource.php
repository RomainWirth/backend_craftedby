<?php

namespace App\Http\Resources;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Item $resource
 */
class ItemResource extends JsonResource
{
    public static $wrap = 'Item';
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'imageUrl' => $this->imageUrl,
            'price' => $this->price,
            'stock' => $this->stock,
            'size' => $this->whenNotNull($this->size),
            'color' => $this->whenNotNull($this->color),
            'materials' => $this->materials,
            'category' => $this->category,
            'artisan' => $this->artisan,
        ];
    }
}
