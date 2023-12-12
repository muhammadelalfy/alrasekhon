<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class MethodResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {

        $this->micro = [
            'id' => $this->id,
            'name' => $this->getTranslations('name'),
            'name_localized' => $this->name,
            'status' => $this->status,
            'last_update' => $this->updated_at->diffForHumans(),
            'created_at' => $this->created_at,
        ];

        $this->mini = [];

        $this->full = [];

        $this->relations = [];

        return $this->getResource();
    }

}
