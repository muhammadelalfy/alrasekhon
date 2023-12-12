<?php

namespace App\Http\Resources;

use App\Models\Sura;
use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class CompetitionLevelResource extends BaseResource
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
        ];

        $this->mini = [
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

        ];

        $this->full = [
            'id' => $this->id,
            'name_localized' => $this->name,
            'name' => $this->getTranslations('name'),
            'competitors_count' => $this->competitors_count,
            'winners_count' => $this->winners_count,
            'save_amount' => $this->save_amount,
            'fromSurah' => $this->fromSurah,
            'toSurah' => $this->toSurah,
            'toSurahOption' => @Sura::find($this->toSurahOption)->name,
            'fromSurahOption' => @Sura::find($this->fromSurahOption)->name,
            'fromAyah' => $this->fromAyah,
            'toAyah' => $this->toAyah,
            'from' => $this->from,
            'to' => $this->to,
            'other_controls' => $this->other_controls,
            'controlName' => $this->controlName
        ];

        $this->relations = [];

        return $this->getResource();
    }
}
