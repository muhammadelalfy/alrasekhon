<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class WarehouseResource extends BaseResource
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
        ];

        $this->mini = [];

        $this->full = [
            'rank' => $this->getRanks()[$this->rank] ?? "",
            'operating_from' => $this->operating_from,
            'operating_to' => $this->operating_to,
            'dynamics_id' => $this->dynamics_id,
            'is_active' => $this->is_active,
            'auto_assign_driver' => $this->auto_assign_driver,
        ];

        $this->relations = [
            'segments' => $this->relationLoaded("segments") ? SegmentResource::collection($this->segments) : [],
        ];

        return $this->getResource();
    }
}
