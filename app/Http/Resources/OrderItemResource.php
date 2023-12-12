<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class OrderItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->dynamics_id,
            'price' => $this->pivot->price,
            'quantity' => $this->pivot->quantity,
            'net_amount' => $this->pivot->net_amount,
            'discount' => $this->pivot->discount
        ];
    }
}
