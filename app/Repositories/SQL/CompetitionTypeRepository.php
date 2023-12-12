<?php

namespace App\Repositories\SQL;

use App\Models\CompetitionType;
use App\Repositories\Contracts\CompetitionTypeContract;

class CompetitionTypeRepository extends BaseRepository implements CompetitionTypeContract
{
    /**
     * CompetitionTypeRepository constructor.
     * @param CompetitionType $model
     */
    public function __construct(CompetitionType $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param CompetitionType $model
     * @return int
     */
     public function relatedData(CompetitionType $model)
     {
        return 0;
     }
}
