<?php
namespace Invento\Product\Resource;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'sku' => $this->sku,
            'description' => $this->description,
            'short_description' => $this->short_description,
            'cost_price' => $this->cost_price,
            'sale_price' => $this->sale_price,
            'discount_price' => $this->discount_price,
            'thumbnail' => $this->thumbnail,
            'meta_title' => $this->meta_title,
            'meta_description'=> $this->meta_description,
            'categories' => ProductCategoryResource::collection($this->whenLoaded('categories')),
        ];
    }
}