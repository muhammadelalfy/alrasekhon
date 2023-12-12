<?php

namespace App\Repositories\Contracts;

use App\Models\CommitteeChairman;

interface CommitteeChairmanContract extends BaseContract
{
    public function relatedData(CommitteeChairman $model);
}

