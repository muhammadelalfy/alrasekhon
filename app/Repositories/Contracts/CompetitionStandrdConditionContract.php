<?php

namespace App\Repositories\Contracts;

use App\Models\CompetitionStandrdCondition;

interface CompetitionStandrdConditionContract extends BaseContract
{
    public function relatedData(CompetitionStandrdCondition $model);
}

