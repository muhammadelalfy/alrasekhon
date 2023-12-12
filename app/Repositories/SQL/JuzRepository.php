<?php

namespace App\Repositories\SQL;

use App\Models\Juz;
use App\Repositories\Contracts\JuzContract;

class JuzRepository extends BaseRepository implements JuzContract
{
    /**
     * JuzRepository constructor.
     * @param Juz $model
     */
    public function __construct(Juz $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param Juz $model
     * @return int
     */
     public function relatedData(Juz $model)
     {
        return 0;
     }
}
