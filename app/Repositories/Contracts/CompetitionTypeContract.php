<?php

namespace App\Repositories\Contracts;

use App\Models\CompetitionType;

interface CompetitionTypeContract extends BaseContract
{
    public function relatedData(CompetitionType $model);
}

