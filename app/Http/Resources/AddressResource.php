<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'address_type' => $this->address_type,
            'address_title' => $this->address_title,
            'address_line_1' => $this->address_line_1,
            'address_line_2' => $this->address_line_2,
            'city' => $this->city,
            'zip_code' => $this->zip_code,
            'country' => new CountryResource($this->country),
            'state' => new StateResource($this->state),
            'phone' => $this->phone,
        ];
    }
}
