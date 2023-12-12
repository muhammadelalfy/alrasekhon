<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContestantResource extends BaseResource
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
            'first_name' => $this->first_name,
            'second_name' => $this->second_name,
            'last_name' => $this->last_name,
            'last_update' => $this->updated_at->diffForHumans(),
            'created_at' => $this->created_at,
        ];

        $levels = $this->levels();
        $this->mini = [
            'birth_date' => $this->birth_date,
            'identity_proof' => $this->identity_proof,
            'national_id' => $this->national_id,
            'passport' => $this->passport,
            'gender' => $this->gender,
            'gender_localized' => __('contestants.'.$this->gender),
            'nationality' => $this->nationality,
            'email' => $this->email,
            'country_code' => $this->country_code,
            'phone' => $this->phone,
            'status' => $this->status,
            'status_localized' => $this->status ? __('contestants.active') : __('contestants.not_active'),
            'qualification' => $this->qualification,
            'job' => $this->job,
            'country_id' => $this->country_id ?? null,
            'country' => $this->country->name ?? '-',
            'governorate_id' => $this->governorate_id,
            'governorate' => $this->governorate->name ?? '-',
            'city_id' => $this->city_id,
            'city' => $this->city->name ?? '-',
            'main_address' => $this->main_address,
            'additional_address' => $this->additional_address,
            'step_no' => $this->step_no,
            'contestant_level_ids' => $levels->pluck('contestant_level_id')->toArray(),
            'file_url' => $this->when($this->file, function (){
                return Storage::url($this->file->url);
            }),
            'file_name' => $this->when($this->file, function (){
                return Storage::url($this->file->name);
            }),
        ];

        $this->full = [];

        $this->relations = [
            'levels' => implode(',', $levels->pluck('name')->toArray())
        ];

        return $this->getResource();
    }
}
