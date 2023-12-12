<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class CountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name_localized' => $this->name,
            'name' => $this->getTranslations('name'),
            'status' => $this->status,
            'country_name_localized' => $this->name,
            'created_at' => $this->created_at->diffforhumans(),
            'updated_at' => $this->updated_at->diffforhumans(),
        ];
    }
}
