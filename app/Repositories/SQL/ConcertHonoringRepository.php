<?php

namespace App\Repositories\SQL;

use App\Models\ConcertHonoring;
use App\Repositories\Contracts\ConcertHonoringContract;

class ConcertHonoringRepository extends BaseRepository implements ConcertHonoringContract
{
    /**
     * ConcertHonoringRepository constructor.
     * @param ConcertHonoring $model
     */
    public function __construct(ConcertHonoring $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param ConcertHonoring $model
     * @return int
     */
     public function relatedData(ConcertHonoring $model)
     {
        return 0;
     }
}
