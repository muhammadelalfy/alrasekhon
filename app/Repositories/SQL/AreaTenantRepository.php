<?php

namespace App\Repositories\SQL;

use App\Models\AreaTenant;
use App\Repositories\Contracts\AreaTenantContract;

class AreaTenantRepository extends BaseRepository implements AreaTenantContract
{
    /**
     * AreaTenantRepository constructor.
     * @param AreaTenant $model
     */
    public function __construct(AreaTenant $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param AreaTenant $model
     * @return int
     */
     public function relatedData(AreaTenant $model)
     {
        return 0;
     }
}
