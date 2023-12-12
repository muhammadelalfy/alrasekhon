<?php

namespace App\Repositories\SQL;

use App\Models\ArbitrationType;
use App\Repositories\Contracts\ArbitrationTypeContract;

class ArbitrationTypeRepository extends BaseRepository implements ArbitrationTypeContract
{
    /**
     * ArbitrationTypeRepository constructor.
     * @param ArbitrationType $model
     */
    public function __construct(ArbitrationType $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param ArbitrationType $model
     * @return int
     */
     public function relatedData(ArbitrationType $model)
     {
        return 0;
     }
}
