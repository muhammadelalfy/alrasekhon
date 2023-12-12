<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class GeneralSettingsResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {

        return [
            'who_are_we_ar' => @$this->who_are_we_ar,
            'who_are_we_en' => @$this->who_are_we_ar,
            'address_ar' => @$this->address_ar,
            'address_en' => @$this->address_en,
            'website_link' => @$this->website_link,
            'embed_map' => @$this->embed_map,
            'whatsapp' => @$this->whatsapp,
            'facebook' => @$this->facebook,
            'twitter' => @$this->twitter,
            'telegram' => @$this->telegram,
            'instagram' => @$this->instagram,
            'help_ar' => @$this->help_ar,
            'help_en' => @$this->help_en,
            'privacy_ar' => @$this->privacy_ar,
            'privacy_en' => @$this->privacy_en,
            'terms_ar' => @$this->terms_ar,
            'terms_en' => @$this->terms_en,
        ];
    }
}
