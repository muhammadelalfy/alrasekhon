<?php

namespace App\Http\Resources;

use App\Constants\OrderStatusConstants;
use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class OrderStatusResource extends JsonResource
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
            'key' => $this->key,
            'value' => $this->value,
            'statusText' => $this->getStatusValueText(),
            'statusColor' => $this->getStatusValueColor(),
            'lat' => $this->lat,
            'lng' => $this->lng,
            'duration' => $this->duration,
            'datetime' => isset($this->datetime)? $this->datetime->format('d-m-Y H:i:s'): "",
        ];
    }

}
