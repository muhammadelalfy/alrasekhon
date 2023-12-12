<?php

namespace App\Repositories\Contracts;

use App\Models\CompetitionLevel;

interface CompetitionLevelContract extends BaseContract
{
    public function relatedData(CompetitionLevel $model);
    public function storeLevel($params);
}

