<?php

namespace App\Http\Resources;

use \Illuminate\Http\Request;

class SegmentResource extends BaseResource
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
            'code' => $this->dynamics_id
        ];

        $this->relations = [
            'parent' => $this->relationLoaded('parent') ? $this->parent?->name : '',
            'parent_id' => $this->relationLoaded('parent') ? $this->parent?->id : '',
            'sub_segments' => $this->relationLoaded('subSegments') ? SegmentResource::collection($this->subSegments) : [],
            'warehouses' => $this->relationLoaded('warehouses') ? WarehouseResource::collection($this->warehouses) : [],
            'nearest_segments' => $this->relationLoaded('nearestSegments') ? SegmentResource::collection($this->nearestSegments) : [],
            'nearest_segments_ids' => $this->relationLoaded('nearestSegments') ? $this->nearestSegments->pluck('id') : [],
        ];

        return $this->getResource();
    }
}
