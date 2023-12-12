<?php

namespace App\Repositories\Contracts;

use App\Models\Advertisement;

interface AdvertisementContract extends BaseContract
{
    public function relatedData(Advertisement $model);
}

