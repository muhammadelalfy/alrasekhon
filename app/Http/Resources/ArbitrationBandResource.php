<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class ArbitrationBandResource extends JsonResource
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
            'arbitration_type_id' => $this->arbitration_type->id,
            'name' => $this->getTranslations('name'),
            'description' => $this->getTranslations('description'),
            'name_localized' => $this->name,
            'description_localized' => $this->description,
            'status' => $this->status,
            'type' => $this->arbitration_type->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

        ];
    }
}
