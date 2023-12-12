<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'status' => $this->status,
            'permissions' => $this->whenLoaded('permissions', function () {
                return $this->permissions->isNotEmpty() ? $this->customizePermissions() : (object)null;
            }),

            'permissions_counts' =>$this->whenLoaded('permissions', function () {
                return $this->permissions->isNotEmpty() ? count($this->customizePermissions()) : 0;
            }),
//            'permissions_names' => $this->whenLoaded('permissions', function () {
//                return $this->permissions->isNotEmpty() ? $this->permissions->pluck('name') : (object)null;
//            }),
        ];
    }

    private function customizePermissions()
    {
        return $this->permissions->groupBy('model')->map(function ($model, $key) {
            return $model->pluck('id');
        })->collect();
    }
}
