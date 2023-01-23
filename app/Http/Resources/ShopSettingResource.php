<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShopSettingResource extends JsonResource
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
            'legal_name' => $this->legal_name,
            'slug' => $this->slug,
            'email' => $this->email,
            'description' => $this->description,
            'external_url' => $this->external_url,
            'time_zone' => $this->time_zone,
            'current_billing_plan' => $this->current_billing_plan,
            'trial_ends_at' => $this->trial_ends_at,
            'active' => (bool) $this->active,
            'payment_verified' => (bool) $this->payment_verified,
            'id_verified' => (bool) $this->id_verified,
            'phone_verified' => (bool) $this->phone_verified,
            'address_verified' => (bool) $this->address_verified,
            'member_since' => $this->created_at,
            'updated_at' => $this->updated_at,
            'logo' => $this->logoImage ? get_storage_file_url($this->logoImage->path) : null,
            'cover_image' => $this->coverImage ? get_storage_file_url($this->coverImage->path) : null,
        ];
    }
}
