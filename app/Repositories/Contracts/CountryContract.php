<?php

namespace App\Repositories\Contracts;

use App\Models\Country;

interface CountryContract extends BaseContract
{
    public function relatedData(Country $model);
}

