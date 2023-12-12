<?php

namespace App\Repositories\Contracts;

use App\Models\City;
use App\Models\Country;

interface CityContract extends BaseContract
{
    public function relatedData(City $model);
//    public function searchMultiCity();
}

