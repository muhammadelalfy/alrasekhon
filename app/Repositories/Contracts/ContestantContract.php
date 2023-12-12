<?php

namespace App\Repositories\Contracts;

use App\Models\Contestant;

interface ContestantContract extends BaseContract
{
    public function relatedData(Contestant $model);
}

