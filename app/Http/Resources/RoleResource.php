<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
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
      'shop_id' => $this->shop_id,
      'description' => $this->description,
      'public' => $this->public,
      'level' => $this->level,
      'permissions' => PermissionResource::collection($this->permissions),
    ];
  }
}
