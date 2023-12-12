<?php

namespace App\Repositories\SQL;

use App\Models\Tenant;
use App\Repositories\Contracts\TenantContract;

class TenantRepository extends BaseRepository implements TenantContract
{
    /**
     * TenantRepository constructor.
     * @param Tenant $model
     */
    public function __construct(Tenant $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param Tenant $model
     * @return int
     */
     public function relatedData(Tenant $model)
     {
        return 0;
     }
}
