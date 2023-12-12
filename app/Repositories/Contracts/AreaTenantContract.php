<?php

namespace App\Repositories\Contracts;

use App\Models\AreaTenant;

interface AreaTenantContract extends BaseContract
{
    public function relatedData(AreaTenant $model);
}

