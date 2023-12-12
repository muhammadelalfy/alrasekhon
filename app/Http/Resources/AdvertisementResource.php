<?php

namespace App\Http\Resources;

use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdvertisementResource extends BaseResource
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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];

        $this->mini = [
            'name' => $this->name,
            'description' => strip_tags($this->description),
            'media_type' => $this->media_type,
            'url' => $this->url,
            'file_url' => $this->when($this->file, function (){
                return Storage::url($this->file->url);
            }),
        ];

        $this->full = [];

        $this->relations = [];

        return $this->getResource();
    }

}
