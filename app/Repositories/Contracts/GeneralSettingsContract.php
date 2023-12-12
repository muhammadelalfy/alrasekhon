<?php

namespace App\Repositories\Contracts;

use App\Models\GeneralSettings;

interface GeneralSettingsContract extends BaseContract
{
    public function relatedData(GeneralSettings $model);
    public function getAll();
}

