<?php

namespace App\Repositories\Contracts;

use App\Models\CustomerGroup;

interface CustomerGroupContract extends BaseContract
{
    public function relatedData(CustomerGroup $model);
}

