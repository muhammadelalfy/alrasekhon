<?php

namespace App\Repositories\Contracts;

use App\Models\Method;

interface MethodContract extends BaseContract
{
    public function relatedData(Method $model);
}

