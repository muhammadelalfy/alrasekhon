<?php

namespace App\Repositories\SQL;

use App\Models\ArbitratorLevel;
use App\Repositories\Contracts\ArbitratorLevelContract;

class ArbitratorLevelRepository extends BaseRepository implements ArbitratorLevelContract
{
    /**
     * ArbitratorLevelRepository constructor.
     * @param ArbitratorLevel $model
     */
    public function __construct(ArbitratorLevel $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param ArbitratorLevel $model
     * @return int
     */
     public function relatedData(ArbitratorLevel $model)
     {
        return 0;
     }
}
