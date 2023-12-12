<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->delete('general.facebook_en');
        $this->migrator->delete('general.telegram_en');
        $this->migrator->delete('general.twitter_en');
        $this->migrator->delete('general.whatsapp_en');
        $this->migrator->delete('general.instagram_en');
        $this->migrator->delete('general.website_link_en');
        $this->migrator->delete('general.embed_map_en');
        $this->migrator->rename('general.facebook_ar', 'general.facebook');
        $this->migrator->rename('general.telegram_ar', 'general.telegram');
        $this->migrator->rename('general.whatsapp_ar', 'general.whatsapp');
        $this->migrator->rename('general.instagram_ar', 'general.instagram');
        $this->migrator->rename('general.twitter_ar', 'general.twitter');
        $this->migrator->rename('general.website_link_ar', 'general.website_link');
        $this->migrator->rename('general.embed_map_ar', 'general.embed_map');
    }
};
