<?php

namespace App\Http\Resources;

use App\Helpers\ListHelper;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id'           => $this->id,
            'slug'         => $this->slug,
            'name'         => $this->name,
            'model_number' => $this->model_number,
            'status'       => $this->active,
            'gtin'         => $this->gtin,
            'gtin_type'    => $this->gtin_type,
            'mpn'          => $this->mpn,
            'brand'        => $this->brand,
            'manufacturer' => [
                'id'   => $this->manufacturer->id,
                'name' => $this->manufacturer->name,
                'slug' => $this->manufacturer->slug,
            ],
            'requirement_shipping' => $this->requires_shipping,
            'categories' => CategoryLightResource::collection($this->categories),
            'origin' => optional($this->origin)->name,
            'listing_count' => $this->inventories_count,
            'description' => $this->description,
            'available_from' => date('F j, Y', strtotime($this->created_at)),
            'images' => ImageResource::collection($this->images),

        ];
    }
}
