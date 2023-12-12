<?php

namespace App\Repositories\SQL;

use App\Models\CustomerGroup;
use App\Repositories\Contracts\CustomerGroupContract;

class CustomerGroupRepository extends BaseRepository implements CustomerGroupContract
{
    /**
     * CustomerGroupRepository constructor.
     * @param CustomerGroup $model
     */
    public function __construct(CustomerGroup $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param CustomerGroup $model
     * @return int
     */
     public function relatedData(CustomerGroup $model)
     {
        return 0;
     }
}
