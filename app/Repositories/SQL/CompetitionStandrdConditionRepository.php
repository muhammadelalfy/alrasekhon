<?php

namespace App\Repositories\SQL;

use App\Models\CompetitionStandrdCondition;
use App\Repositories\Contracts\CompetitionStandrdConditionContract;

class CompetitionStandrdConditionRepository extends BaseRepository implements CompetitionStandrdConditionContract
{
    /**
     * CompetitionStandrdConditionRepository constructor.
     * @param CompetitionStandrdCondition $model
     */
    public function __construct(CompetitionStandrdCondition $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param CompetitionStandrdCondition $model
     * @return int
     */
     public function relatedData(CompetitionStandrdCondition $model)
     {
        return 0;
     }
}
