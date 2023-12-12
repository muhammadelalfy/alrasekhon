<?php

namespace App\Repositories\Contracts;

use App\Models\ViceCommitteeChairman;

interface ViceCommitteeChairmanContract extends BaseContract
{
    public function relatedData(ViceCommitteeChairman $model);
}

