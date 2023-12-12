<?php

namespace App\Repositories\SQL;

use App\Models\ViceCommitteeChairman;
use App\Repositories\Contracts\ViceCommitteeChairmanContract;

class ViceCommitteeChairmanRepository extends BaseRepository implements ViceCommitteeChairmanContract
{
    /**
     * ViceCommitteeChairmanRepository constructor.
     * @param ViceCommitteeChairman $model
     */
    public function __construct(ViceCommitteeChairman $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param ViceCommitteeChairman $model
     * @return int
     */
     public function relatedData(ViceCommitteeChairman $model)
     {
        return 0;
     }
}
