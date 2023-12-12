<?php

namespace App\Models;

use Spatie\LaravelSettings\Settings;
use Spatie\Translatable\HasTranslations;

class GeneralSettings extends Settings
{
    public string $who_are_we_ar;
    public string $who_are_we_en;
    public string $address_ar;
    public string $address_en;
    public string $website_link;
    public string $embed_map;
    public string $whatsapp;
    public string $facebook;
    public string $twitter;
    public string $telegram;
    public string $instagram;
    public string $help_ar;
    public string $help_en;

    public string $privacy_ar;
    public string $privacy_en;

    public string $terms_ar;
    public string $terms_en;
    public string $site_name;


    public static function group(): string
    {
        return 'general';
    }

    public static function getSettingValue($key): string
    {
        return app(self::class)->$key;
    }


}
