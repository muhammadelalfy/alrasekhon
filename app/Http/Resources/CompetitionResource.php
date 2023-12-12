<?php

namespace App\Http\Resources;

use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompetitionResource extends BaseResource
{

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $ageGroups = [];
        $prize = [];
        $levels = $this->levels;

        // Draft
        $stepStatusTabs = 1;

        //Announces
        if ($this->is_announced){
            $stepStatusTabs = 2;
        }

        //In progress
        if ((is_array($this->steps_numbers) && count($this->steps_numbers) == 9) &&
            date('Y-m-d', strtotime($this->competition_date[0])) == date('Y-m-d', time())){
            $stepStatusTabs = 3;
        }

        // Completed
        if ((is_array($this->steps_numbers) && count($this->steps_numbers) == 9) &&
            date('Y-m-d', strtotime($this->competition_date[1])) == date('Y-m-d', time())){
            $stepStatusTabs = 4;
        }

        foreach ($this->age_from as $key => $item) {
            $ageGroups[] = "$item:{$this->age_to[$key]}";
        }

        if ($this->prize){
            foreach ($this->prize->prize_data as $levelId => $prizeData) {
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
        } else {
            if (count($levels)){
                foreach ($levels as $level) {
                    $prize[$level->id] = [
                        'competition_levels_names' => $level->name,
                        'winners_counts' => $level->competitors_count,
                        'winners_rankings' => [],
                        'financials_awards_values' => [],
                        'certificates_and_honors' => [],
                    ];
                }
            }
        }


        $this->micro = [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => $this->created_at,
        ];
        $this->mini = [
            'competition_address' => $this->competition_address,
            'location' => $this->location,
            'country_id' => $this->country_id,
            'governorate_id' => $this->governorate_id,
            'city_id' => $this->city_id,
            'country' => $this->when($this->country, function (){
                return $this->country->name;
            }),
            'concert_honoring' => $this->when($this->concert_honoring, function (){
                return ConcertHonoringResource::make($this->concert_honoring);
            }),
            'governorate' => $this->when($this->governorate, function (){
                return $this->governorate->name;
            }),
            'city' => $this->when($this->city, function (){
                return $this->city->name;
            }),
            'age_group' => $this->age_group,
            'age_from' => $this->age_from,
            'age_to' => $this->age_to,
            'ageGroups' => $ageGroups,
            'competition_type_name' => $this->when($this->competitionType, function (){
                return $this->competitionType->name;
            }),
            'advertisement_id' => $this->advertisement_id,
            'competition_type_id' => $this->competition_type_id,
            'competition_date' => $this->competition_date,
            'competition_start_date' => date('Y-m-d', strtotime($this->competition_date[0])),
            'competition_end_date' => date('Y-m-d', strtotime($this->competition_date[1])),
            'registration_date' => $this->registration_date,
            'competitors_max_num' => $this->competitors_max_num,
            'competition_budget' => $this->competition_budget,
            'competition_photo_id' => $this->competition_photo_id,
            // To check if competition in progress or not to active In progress status tab in competitions
            'status' => $this->status,
            'status_localized' => $this->status ? __('arbitrators.active') : __('arbitrators.not_active'),
            'competition_photo' => $this->when($this->competitionPhoto, function (){
                return Storage::url($this->competitionPhoto->url);
            }),
            'stages' => $this->when($this->stages, function (){
                return StageResource::collection($this->stages);
            }),
            'prize' => $prize,
            'standard_condition_description' => $this->when($this->standardCondition, function (){
                return $this->standardCondition->standard_condition_description;
            }),
            'steps_numbers' => $this->steps_numbers ?? [],
            'is_show_announce_button' => (count($this->steps_numbers ?? []) == 8  && !in_array(9, $this->steps_numbers) || count($this->steps_numbers ?? []) == 9),
            'step_status_tabs' => $stepStatusTabs,
            'is_announced' => $this->is_announced,
            'request_action' => '',
            'competition_levels' =>$this->when($levels, function (){
                return CompetitionLevelResource::collection($this->levels);
            }),
        ];

        $this->full = [];

        $this->relations = [];

        return $this->getResource();
    }
}
