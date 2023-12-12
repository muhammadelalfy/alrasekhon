<?php

namespace App\Repositories\Contracts;

use App\Models\ContestantLevel;

interface ContestantLevelContract extends BaseContract
{
    public function relatedData(ContestantLevel $model);
}

