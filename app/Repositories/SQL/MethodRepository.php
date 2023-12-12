<?php

namespace App\Repositories\SQL;

use App\Models\Method;
use App\Repositories\Contracts\MethodContract;

class MethodRepository extends BaseRepository implements MethodContract
{
    /**
     * MethodRepository constructor.
     * @param Method $model
     */
    public function __construct(Method $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param Method $model
     * @return int
     */
     public function relatedData(Method $model)
     {
        return 0;
     }
}
