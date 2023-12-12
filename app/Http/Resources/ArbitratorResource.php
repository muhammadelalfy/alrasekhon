<?php

namespace App\Http\Resources;

use App\Models\Method;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArbitratorResource extends BaseResource
{

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $authorizations = [];
        $attachUrls = [];
        $attachIds = [];
        $methodsReadingsIds = [];
        $appendMethodReadingsNames = [];
        $methodsIds = [];
        $readingsNames = [];


        foreach ($this->readings as $reading) {
            $methodId = $reading->pivot->method_id;
            $methodsReadingsIds[$methodId][] = $reading->pivot->reading_id;
            $methodsIds[] = $methodId;
            $method = Method::find($reading->pivot->method_id);
            $readingsNames[] = $method->name;
            $appendMethodReadingsNames[] = [
                'method_id' => $reading->pivot->method_id,
                'method_name' => $method->name,
                'readings' => [$reading->name]
            ];

        }


        $groupedData = array_reduce($appendMethodReadingsNames, function ($result, $item){
            $methodId = $item['method_id'];
            if (!isset($result[$methodId])){
                $result[$methodId] = [
                    'method_id' => $item['method_id'],
                    'method_name' => $item['method_name'],
                    'readings' => []
                ];
            }

            $result[$methodId]['readings'][] = $item['readings'][0];
            return $result;
        }, []);

        $groupedData = array_values($groupedData);


        if (count($this->authorizations)){
            foreach ($this->authorizations as $item) {
                $authorizations[] = $item['authorization'];
                $attachUrls[] = $item['attach_url'];
                $attachIds[] = $item['attach_id'];
            }
        }
        $this->micro = [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'second_name' => $this->second_name,
            'last_name' => $this->last_name,
            'full_name' => "{$this->first_name} {$this->second_name} {$this->last_name}",
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
            'gender_localized' => __('arbitrators.'.$this->gender),
            'nationality' => $this->nationality,
            'email' => $this->email,
            'country_code' => $this->country_code,
            'phone' => $this->phone,
            'status' => $this->status,
            'status_localized' => $this->status ? __('arbitrators.active') : __('arbitrators.not_active'),
            'qualification' => $this->qualification,
            'job' => $this->job,
            'is_teacher' => (boolean) $this->is_teacher,
            'is_teacher_localized' => $this->is_teacher ? __('arbitrators.yes') : __('arbitrators.no'),
            'work_experiences' => $this->work_experiences ?? [],
            'work_experiences_count' => count($this->work_experiences ?? []),
            'practical_experiences' => $this->practical_experiences ?? [],
            'practical_experiences_count' => count($this->practical_experiences ?? []),
            'authorizations' => $authorizations,
            'vocation_bonds_attaches' => $attachIds,
            'vocation_bonds_attach_urls' => $attachUrls,
            'authorizations_count' => count($this->authorizations ?? []),
            'additional_address' => $this->additional_address,
            'main_address' => $this->main_address,
            'country' => $this->country->name ?? null,
            'country_id' => $this->country_id ?? null,
            'governorate' => $this->governorate->name ?? null,
            'governorate_id' => $this->governorate_id,
            'city' => $this->city->name ?? null,
            'city_id' => $this->city_id,
            'profile_photo' => $this->when($this->profilePhoto, function (){
                return Storage::url($this->profilePhoto->url);
            }),
            'contract_attach' => $this->when($this->contractAttachment, function (){
                return Storage::url($this->contractAttachment->url);
            }) ,
            'arbitrator_level_ids' => $this->levels()->pluck('arbitrator_level_id')->toArray(),
            'step_no' => $this->step_no,
            'method_id' => '',
            'method_name' => '',
            'methods_readings_ids' => $methodsReadingsIds,
            'readings_names' => array_values(array_unique($readingsNames)) ?? [],
            'append_method_readings_names' => $groupedData ?? [],
//            'appended_methods_readings' => $this->whereHas('readings', function ($query){
//                $query->where(['arbitrator_id' => $this->id]);
//            }),
//            'file_name' => $this->file ? $this->file->name : null,
//            'file_url' => $this->file ? Storage::url($this->file->url) : null,

        ];

        $this->full = [];

        $this->relations = [
            'levels' => implode(',', $levels->pluck('name')->toArray())
        ];

        return $this->getResource();
    }
}
