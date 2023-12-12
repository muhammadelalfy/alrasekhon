<?php

namespace App\Repositories\SQL;

use App\Models\Reading;
use App\Repositories\Contracts\ReadingContract;

class ReadingRepository extends BaseRepository implements ReadingContract
{
    /**
     * ReadingRepository constructor.
     * @param Reading $model
     */
    public function __construct(Reading $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param Reading $model
     * @return int
     */
     public function relatedData(Reading $model)
     {
        return 0;
     }
}
