<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class CommitteeChairmanResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $this->micro = [
            'id' => $this->id,
            'status' => $this->status,
        ];

        $this->mini = [
            'name_localized' => $this->name,
            'name' => $this->getTranslations('name'),
        ];

        $this->full = [];

        $this->relations = [];

        return $this->getResource();
    }
}
