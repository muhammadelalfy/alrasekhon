<?php

namespace App\Repositories\Contracts;

use App\Models\Tenant;

interface TenantContract extends BaseContract
{
    public function relatedData(Tenant $model);
}

