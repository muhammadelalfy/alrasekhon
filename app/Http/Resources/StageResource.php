<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class StageResource extends BaseResource
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
            'name' => $this->name,
            'competition_id' => $this->competition_id,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ];

        $this->mini = [];

        $this->full = [
        ];

        $this->relations = [

        ];

        return $this->getResource();
    }
}
