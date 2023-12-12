<?php

namespace App\Repositories\SQL;

use App\Models\ContestantLevel;
use App\Repositories\Contracts\ContestantLevelContract;

class ContestantLevelRepository extends BaseRepository implements ContestantLevelContract
{
    /**
     * ContestantLevelRepository constructor.
     * @param ContestantLevel $model
     */
    public function __construct(ContestantLevel $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param ContestantLevel $model
     * @return int
     */
     public function relatedData(ContestantLevel $model)
     {
        return 0;
     }
}
