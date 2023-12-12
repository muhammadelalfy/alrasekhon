<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->dynamics_id,
            'name' => $this->name,
            'phone' => $this->phone,
            'address' => $this->address,
            'group' => $this->whenLoaded('group' , new CustomerGroupResource($this->group)),
            'segment' => $this->whenLoaded('segment', new SegmentResource($this->segment)),
            'parent_segment_id' => $this->whenLoaded('segment', function(){return $this->segment?->parent->id;}),
            'segment_id' => $this->segment_id,
            'group_id' => $this->group_id,
            'standard_delivery_time' => $this->standard_delivery_time,
        ];
    }
}
