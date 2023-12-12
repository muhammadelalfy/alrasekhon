<?php

namespace App\Repositories\Contracts;

use App\Models\Arbitrator;

interface ArbitratorContract extends BaseContract
{
    public function relatedData(Arbitrator $model);
}

