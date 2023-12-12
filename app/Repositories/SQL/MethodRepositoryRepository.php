<?php

namespace App\Repositories\SQL;

use App\Models\MethodRepository;
use App\Repositories\Contracts\MethodRepositoryContract;

class MethodRepositoryRepository extends BaseRepository implements MethodRepositoryContract
{
    /**
     * MethodRepositoryRepository constructor.
     * @param MethodRepository $model
     */
    public function __construct(MethodRepository $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param MethodRepository $model
     * @return int
     */
     public function relatedData(MethodRepository $model)
     {
        return 0;
     }
}
