<?php

namespace App\Repositories\SQL;

use App\Models\CommitteeChairman;
use App\Repositories\Contracts\CommitteeChairmanContract;

class CommitteeChairmanRepository extends BaseRepository implements CommitteeChairmanContract
{
    /**
     * CommitteeChairmanRepository constructor.
     * @param CommitteeChairman $model
     */
    public function __construct(CommitteeChairman $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param CommitteeChairman $model
     * @return int
     */
     public function relatedData(CommitteeChairman $model)
     {
        return 0;
     }
}
