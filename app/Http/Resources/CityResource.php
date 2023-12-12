<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class CityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
//        dd($this);
        return [
            'id' => $this->id,
            'name_localized' => $this->name,
            'country_name_localized' => $this->governorate->country->name,
            'governorate_name_localized' => $this->governorate->name,
            'name' => $this->getTranslations('name'),
            'country_id' => $this->governorate->country_id,
            'governorate_id' => $this->governorate_id,
            'status' => $this->status,
            'rows' => [],
            'created_at' => $this->created_at->diffforhumans(),
            'updated_at' => $this->updated_at->diffforhumans(),
        ];
    }
}
