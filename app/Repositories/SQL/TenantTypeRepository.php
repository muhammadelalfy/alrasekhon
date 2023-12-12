<?php

namespace App\Repositories\SQL;

use App\Models\TenantType;
use App\Repositories\Contracts\TenantTypeContract;

class TenantTypeRepository extends BaseRepository implements TenantTypeContract
{
    /**
     * TenantTypeRepository constructor.
     * @param TenantType $model
     */
    public function __construct(TenantType $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param TenantType $model
     * @return int
     */
     public function relatedData(TenantType $model)
     {
        return 0;
     }
}
