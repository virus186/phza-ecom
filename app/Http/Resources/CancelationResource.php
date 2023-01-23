<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CancelationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'shop_id' => $this->shop_id,
            'cancellation_reason_id' => $this->cancellation_reason_id,
            'customer_id' => $this->customer_id,
            'order_id' => $this->order_id,
            'items' => $this->items,
            'description' => $this->description,
            'return_goods' => $this->returen_goods,
            'status' => $this->status,
        ];

    }
}
