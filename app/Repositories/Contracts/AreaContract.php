<?php

namespace App\Repositories\Contracts;

use App\Models\Area;

interface AreaContract extends BaseContract
{
    public function relatedData(Area $model);
}

