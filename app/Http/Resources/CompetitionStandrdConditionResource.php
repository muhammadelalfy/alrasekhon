<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class CompetitionStandrdConditionResource extends BaseResource
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
        ];

        $this->mini = [
            'description' => $this->description,
        ];

        $this->full = [];

        $this->relations = [];

        return $this->getResource();
    }
}
