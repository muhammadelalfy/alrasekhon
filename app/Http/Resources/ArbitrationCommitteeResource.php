<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class ArbitrationCommitteeResource extends BaseResource
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
            'competition_id' => $this->competition_id,
            'name_localized' => $this->name,
            'name' => $this->getTranslations('name'),
//            'competition_level_ids' => $this->when($this->competitionLevel, function (){
//                return $this->competitionLevel()->pluck('competition_level_id')->toArray();
//            }),
//            'stage_ids' => $this->when($this->stage, function (){
//                return $this->stage()->pluck('stage_id')->toArray();
//            }),
//            'committee_member_ids' => $this->when($this->committeeMember, function (){
//                return $this->committeeMember()->pluck('committee_member_id')->toArray();
//            }),
            'committee_chairman_id' => $this->committee_chairman_id,
            'vice_committee_chairman_id' => $this->vice_committee_chairman_id,
            'arbitrators_number' => $this->arbitrators_number,
            'competition_levels' => $this->when($this->competitionLevel, function (){
                return CompetitionLevelResource::collection($this->competitionLevel);
            }),
            'competition_level_ids' => $this->when($this->competitionLevel, function (){
                return $this->competitionLevel()->pluck('competition_level_id')->toArray();
            }),
            'stages' => $this->when($this->stage, function (){
                return StageResource::collection($this->stage);
            }),
            'stage_ids' => $this->when($this->stage, function (){
                return$this->stage()->pluck('stage_id')->toArray();
            }),
            'committee_members' =>$this->when($this->committeeMember, function (){
                return CommitteeMemberResource::collection($this->committeeMember);
            }),
            'committee_member_ids' =>$this->when($this->committeeMember, function (){
                return $this->committeeMember()->pluck('committee_member_id')->toArray();
            }),
            'committee_chairman' => $this->when($this->committeeChairman, function (){
                return $this->committeeChairman->name;
            }),
            'vice_committee_chairman' => $this->when($this->viceCommitteeChairman, function (){
                return $this->viceCommitteeChairman->name;
            }),
        ];

        $this->full = [];

        $this->relations = [];

        return $this->getResource();
    }
}
