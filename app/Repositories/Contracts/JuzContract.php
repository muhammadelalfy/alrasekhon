<?php

namespace App\Repositories\Contracts;

use App\Models\Juz;

interface JuzContract extends BaseContract
{
    public function relatedData(Juz $model);
}

