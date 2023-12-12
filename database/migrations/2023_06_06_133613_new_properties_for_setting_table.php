<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        $this->migrator->add('general.who_are_we', 'موقع إلكتروني وتطبيق يقوم بتنظيم وإقامة مسابقات القرآن الكريم داخل دولة الكويت وجميع دول العالم
');
        $this->migrator->add('general.address', '');
        $this->migrator->add('general.website_link', '');
        $this->migrator->add('general.embed_map', '');
        $this->migrator->add('general.whatsapp', '');
        $this->migrator->add('general.facebook', '');
        $this->migrator->add('general.twitter', '');
        $this->migrator->add('general.telegram', '');
        $this->migrator->add('general.instagram', '');
        $this->migrator->add('general.help', '');
        $this->migrator->add('general.privacy', '');
        $this->migrator->add('general.terms', '');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
