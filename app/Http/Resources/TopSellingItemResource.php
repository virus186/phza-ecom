<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TopSellingItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'sku' => $this->sku,
            'title' => $this->title,
            'product_id' => $this->product_id,
            'sold_qtt' => $this->sold_qtt,
            'stock_quantity' => $this->stock_quantity,
            'price' => get_formated_currency($this->sale_price, config('system_settings.decimals', 2)),
            'gross_sales' => get_formated_currency($this->gross_sales, config('system_settings.decimals', 2)),
            'active' => $this->active,
            'image' => get_inventory_img_src($this, 'medium'),
        ];
    }
}
