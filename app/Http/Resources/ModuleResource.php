<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ModuleResource extends JsonResource
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
      'access' => $this->access,
      'description' => $this->description,
      'actions' => $this->actions,
      'active' => $this->active,
      'permissions' => PermissionResource::collection($this->permissions),
    ];
  }
}
