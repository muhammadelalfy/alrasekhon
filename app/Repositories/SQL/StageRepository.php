<?php

namespace App\Repositories\SQL;

use App\Models\Stage;
use App\Repositories\Contracts\StageContract;

class StageRepository extends BaseRepository implements StageContract
{
    /**
     * StageRepository constructor.
     * @param Stage $model
     */
    public function __construct(Stage $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param Stage $model
     * @return int
     */
     public function relatedData(Stage $model)
     {
        return 0;
     }
}
