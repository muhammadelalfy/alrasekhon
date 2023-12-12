<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class GovernorateResource extends JsonResource
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
            'name' => $this->getTranslations('name'),
            'name_localized' => $this->name,
            'governorate_name_localized' => $this->name,
            'country_id' => $this->country->id,
            'country_name_localized' => $this->country->name,
            'status' => (boolean) $this->status,
            'created_at' => $this->created_at->diffforhumans(),
            'updated_at' => $this->updated_at->diffforhumans(),
        ];
    }
}
