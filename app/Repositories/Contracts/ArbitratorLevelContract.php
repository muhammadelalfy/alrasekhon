<?php

namespace App\Repositories\Contracts;

use App\Models\ArbitratorLevel;

interface ArbitratorLevelContract extends BaseContract
{
    public function relatedData(ArbitratorLevel $model);
}

