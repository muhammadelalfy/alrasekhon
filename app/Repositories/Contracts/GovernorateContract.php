<?php

namespace App\Repositories\Contracts;

use App\Models\Governorate;

interface GovernorateContract extends BaseContract
{
    public function relatedData(Governorate $model);
}

