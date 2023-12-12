<?php

namespace App\Repositories\Contracts;

use App\Models\Stage;

interface StageContract extends BaseContract
{
    public function relatedData(Stage $model);
}

