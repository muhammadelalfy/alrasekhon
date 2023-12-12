<?php

namespace App\Repositories\Contracts;

use App\Models\ConcertHonoring;

interface ConcertHonoringContract extends BaseContract
{
    public function relatedData(ConcertHonoring $model);
}

