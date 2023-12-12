<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ArbitratorLevelResource extends BaseResource
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
            'description_localized' => !empty($this->description) ? Str::limit(strip_tags($this->description)) : '............................',
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
            'last_update' => $this->updated_at->diffForHumans(),
            'status' => $this->status,
        ];

        $this->mini = [
            'name' => $this->getTranslations('name'),
            'description' => $this->getTranslations('description'),
        ];

        $this->full = [
        ];

        $this->relations = [

        ];

        return $this->getResource();
    }
}
