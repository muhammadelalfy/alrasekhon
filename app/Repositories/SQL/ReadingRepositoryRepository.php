<?php

namespace App\Repositories\SQL;

use App\Models\ReadingRepository;
use App\Repositories\Contracts\ReadingRepositoryContract;

class ReadingRepositoryRepository extends BaseRepository implements ReadingRepositoryContract
{
    /**
     * ReadingRepositoryRepository constructor.
     * @param ReadingRepository $model
     */
    public function __construct(ReadingRepository $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param ReadingRepository $model
     * @return int
     */
     public function relatedData(ReadingRepository $model)
     {
        return 0;
     }
}
