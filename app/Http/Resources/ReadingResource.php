<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class ReadingResource extends BaseResource
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
            'method_id' => $this->method_id,
            'method' => $this->when($this->method, function (){
                return $this->method->name;
            }),
            'last_update' => $this->updated_at->diffForHumans(),
            'created_at' => $this->created_at,
        ];

        $this->mini = [];

        $this->full = [];

        $this->relations = [];

        return $this->getResource();
    }
}
