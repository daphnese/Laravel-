<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        return parent::toArray($request);
        return [
            'product_id' => $this->product_id,
            'image' => $this->image,
            'name' => $this->name,
            'category' => new CategoryResource($this->category),
            'price' => $this->price,
            'description' => $this->description
        ];
    }
}
