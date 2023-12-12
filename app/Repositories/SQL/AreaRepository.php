<?php

namespace App\Repositories\SQL;

use App\Models\Area;
use App\Repositories\Contracts\AreaContract;

class AreaRepository extends BaseRepository implements AreaContract
{
    /**
     * AreaRepository constructor.
     * @param Area $model
     */
    public function __construct(Area $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param Area $model
     * @return int
     */
     public function relatedData(Area $model)
     {
        return 0;
     }
}
