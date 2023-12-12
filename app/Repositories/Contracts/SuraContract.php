<?php

namespace App\Repositories\Contracts;

use App\Models\Sura;

interface SuraContract extends BaseContract
{
    public function relatedData(Sura $model);
}

