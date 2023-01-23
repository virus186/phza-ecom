<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
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
            'name' => $this->name,
            'full_name' => $this->full_name,
            'iso_code' => $this->iso_code,
            'calling_code' => $this->calling_code,
            'timezone_id' => $this->timezone_id,
            'currency_id' => $this->currency_id,
            'eea' => (bool) $this->eea,
            'active' => (bool) $this->active,
        ];
    }
}
