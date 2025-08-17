<?php

declare(strict_types=1);

namespace App\Http\Resources\V1;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Restaurant
 */
final class RestaurantResource extends JsonResource
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
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'users' => UserResource::collection($this->whenLoaded('users')),
            'categories' => CategoryResource::collection($this->whenLoaded('categories')),
            'items' => ItemResource::collection($this->whenLoaded('items')),
        ];
    }
}
