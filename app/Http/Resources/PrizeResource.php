<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class PrizeResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */

    public function toArray($request): array
    {
       $prize = [];

        foreach ($this->prize_data as $levelId => $prizeData) {
            if (is_integer($levelId)){
                $prize[$levelId] = [
                    'competition_levels_names' => $prizeData['competition_levels_names'],
                    'winners_counts' => $prizeData['winners_counts'],
                    'winners_rankings' => $prizeData['winners_rankings'],
                    'financials_awards_values' => $prizeData['financials_awards_values'],
                    'certificates_and_honors' => $prizeData['certificates_and_honors'],
                ];
            }

       }

        $this->micro = [
            'id' => $this->id,
            'competition_id' => $this->prize_data['competition_id'],
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ];

        $this->mini = $prize;

        $this->full = [
        ];

        $this->relations = [

        ];


        return $this->getResource();
    }
}
