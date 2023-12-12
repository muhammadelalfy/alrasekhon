<?php

namespace App\Repositories\Contracts;

use App\Models\TenantType;

interface TenantTypeContract extends BaseContract
{
    public function relatedData(TenantType $model);
}

