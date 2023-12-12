<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->rename('general.who_are_we', 'general.who_are_we_ar');
        $this->migrator->add('general.who_are_we_en', '');
        $this->migrator->rename('general.address', 'general.address_ar');
        $this->migrator->add('general.address_en', '');
        $this->migrator->rename('general.website_link', 'general.website_link_ar');
        $this->migrator->add('general.website_link_en', '');
        $this->migrator->rename('general.embed_map', 'general.embed_map_ar');
        $this->migrator->add('general.embed_map_en', '');
        $this->migrator->rename('general.whatsapp', 'general.whatsapp_ar');
        $this->migrator->add('general.whatsapp_en', '');
        $this->migrator->rename('general.facebook', 'general.facebook_ar');
        $this->migrator->add('general.facebook_en', '');
        $this->migrator->rename('general.twitter', 'general.twitter_ar');
        $this->migrator->add('general.twitter_en', '');
        $this->migrator->rename('general.telegram', 'general.telegram_ar');
        $this->migrator->add('general.telegram_en', '');
        $this->migrator->rename('general.instagram', 'general.instagram_ar');
        $this->migrator->add('general.instagram_en', '');
        $this->migrator->rename('general.help', 'general.help_ar');
        $this->migrator->add('general.help_en', '');
        $this->migrator->rename('general.privacy', 'general.privacy_ar');
        $this->migrator->add('general.privacy_en', '');
        $this->migrator->rename('general.terms', 'general.terms_ar');
        $this->migrator->add('general.terms_en', '');
    }
};
