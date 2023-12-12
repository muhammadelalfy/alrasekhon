<?php

namespace App\Repositories\Contracts;

use App\Models\Reading;

interface ReadingContract extends BaseContract
{
    public function relatedData(Reading $model);
}

