<?php

namespace App\Http\Resources;

use \Illuminate\Http\Request;


/**
 * @property mixed id
 * @property mixed $updated_at
 * @property mixed created_at
 * @property mixed location
 * @property mixed date
 * @property mixed city_id
 * @property mixed competition_id
 * @property mixed competition_place
 */
class ConcertHonoringResource extends BaseResource
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
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ];

        $this->mini = [
            'location' => $this->location,
            'date' => $this->date,
            'city_id' => $this->city_id,
            'competition_id' => $this->competition_id,
            'competition_place' => $this->competition_place,
        ];

        $this->full = [
//            'city' => $this->when($this->city, function (){
//                return CityResource::collection($this->city);
//            }),
        ];

        $this->relations = [

        ];

        return $this->getResource();
    }
}
