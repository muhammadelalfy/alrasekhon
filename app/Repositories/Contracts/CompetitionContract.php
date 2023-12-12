<?php

namespace App\Repositories\Contracts;

use App\Http\Requests\Api\V1\ConcertHonoringRequest;
use App\Http\Requests\Api\V1\PrizeRequest;
use App\Models\Competition;
use App\Models\Prize;

interface CompetitionContract extends BaseContract
{
    public function relatedData(Competition $model);
}



