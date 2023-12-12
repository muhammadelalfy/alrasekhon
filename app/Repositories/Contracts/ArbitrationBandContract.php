<?php

namespace App\Repositories\Contracts;

use App\Models\ArbitrationBand;

interface ArbitrationBandContract extends BaseContract
{
    public function relatedData(ArbitrationBand $model);
}

