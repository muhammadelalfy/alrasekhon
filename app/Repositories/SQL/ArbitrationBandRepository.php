<?php

namespace App\Repositories\SQL;

use App\Models\ArbitrationBand;
use App\Repositories\Contracts\ArbitrationBandContract;

class ArbitrationBandRepository extends BaseRepository implements ArbitrationBandContract
{
    /**
     * ArbitrationBandRepository constructor.
     * @param ArbitrationBand $model
     */
    public function __construct(ArbitrationBand $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param ArbitrationBand $model
     * @return int
     */
     public function relatedData(ArbitrationBand $model)
     {
        return 0;
     }
}
