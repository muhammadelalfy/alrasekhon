<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SampleResource extends BaseResource
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
            'name_localized' => !empty($this->name) ? Str::limit($this->name, 50) : '............................',
            'contract_category_localized' => __('pages.contract_'.$this->contract_category),
            'contract_category' => $this->contract_category,
            'last_update' => $this->updated_at->diffForHumans(),
            'created_at' => $this->created_at->format('Y-m-d'),
        ];

        $this->mini = [
            'name' => $this->getTranslations('name'),
            'file_url' => $this->when($this->file, function (){
                return Storage::url($this->file->url);
            }),
            'file_name' => $this->when($this->file, function (){
                return Storage::url($this->file->name);
            }),
        ];

        $this->full = [];

        $this->relations = [];

        return $this->getResource();
    }

}
