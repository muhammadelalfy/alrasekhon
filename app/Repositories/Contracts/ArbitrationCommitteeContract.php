<?php

namespace App\Repositories\Contracts;

use App\Models\ArbitrationCommittee;

interface ArbitrationCommitteeContract extends BaseContract
{
    public function relatedData(ArbitrationCommittee $model);
}

