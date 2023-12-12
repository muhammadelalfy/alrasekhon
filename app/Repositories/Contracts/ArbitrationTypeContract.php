<?php

namespace App\Repositories\Contracts;

use App\Models\ArbitrationType;

interface ArbitrationTypeContract extends BaseContract
{
    public function relatedData(ArbitrationType $model);
}

