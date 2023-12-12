<?php

namespace App\Repositories\SQL;

use App\Models\Sura;
use App\Repositories\Contracts\SuraContract;

class SuraRepository extends BaseRepository implements SuraContract
{
    /**
     * SuraRepository constructor.
     * @param Sura $model
     */
    public function __construct(Sura $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param Sura $model
     * @return int
     */
     public function relatedData(Sura $model)
     {
        return 0;
     }
}
