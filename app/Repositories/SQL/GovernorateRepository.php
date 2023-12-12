<?php

namespace App\Repositories\SQL;

use App\Models\Governorate;
use App\Repositories\Contracts\GovernorateContract;

class GovernorateRepository extends BaseRepository implements GovernorateContract
{
    /**
     * GovernorateRepository constructor.
     * @param Governorate $model
     */
    public function __construct(Governorate $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param Governorate $model
     * @return int
     */
     public function relatedData(Governorate $model)
     {
        return 0;
     }

}
