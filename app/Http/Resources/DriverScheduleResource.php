<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class DriverScheduleResource extends JsonResource
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
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'days_count' => $this->relationLoaded("days") ? $this->days->count() : 0,
            'state_text' => $this->getStateText(),
            'state_style' => $this->getStateStyle(),
            'can_repeat' => $this->canRepeat(),
            'can_delete' => $this->canDelete(),
            'default_start_time' => $this->default_start_time,
            'default_end_time' => $this->default_end_time,

            // relations
            'days' => $this->relationLoaded("days") ? DriverScheduleDayResource::collection($this->days) : [],
        ];
    }
}
