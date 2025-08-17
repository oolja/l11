<?php

declare(strict_types=1);

namespace App\Http\Resources\V1;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Item
 */
final class ItemResource extends JsonResource
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
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'restaurant' => RestaurantResource::make($this->whenLoaded('restaurant')),
            'categories' => CategoryResource::collection($this->whenLoaded('categories')),
        ];
    }
}
