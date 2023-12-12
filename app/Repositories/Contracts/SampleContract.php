<?php

namespace App\Repositories\Contracts;

use App\Models\Sample;

interface SampleContract extends BaseContract
{
    public function relatedData(Sample $model);
}

