<?php

namespace App\Repositories\SQL;

use App\Models\Permission;
use App\Repositories\Contracts\PermissionContract;

class PermissionRepository extends BaseRepository implements PermissionContract
{
    /**
     * PermissionRepository constructor.
     * @param Permission $model
     */
    public function __construct(Permission $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param Permission $model
     * @return int
     */
     public function relatedData(Permission $model)
     {
        return 0;
     }
}
