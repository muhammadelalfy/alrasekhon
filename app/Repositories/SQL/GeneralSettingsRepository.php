<?php

namespace App\Repositories\SQL;

use App\Models\GeneralSettings;
use App\Repositories\Contracts\GeneralSettingsContract;

class GeneralSettingsRepository extends BaseRepository implements GeneralSettingsContract
{
    /**
     * GeneralSettingsRepository constructor.
     * @param GeneralSettings $model
     */
    public function __construct(GeneralSettings $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param GeneralSettings $model
     * @return int
     */
    public function relatedData(GeneralSettings $model)
    {
        return 0;
    }

    public function getAll():array
    {
        $result = [];
        $availableSettings = config('settings.settings');
        foreach ($availableSettings as $settingClass) {
            $settings = app($settingClass);
            $result[$settings->group()] = $settings->toArray();
        }
        return  $result;
    }
}
