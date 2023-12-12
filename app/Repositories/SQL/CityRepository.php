<?php

namespace App\Repositories\SQL;

use App\Models\City;
use App\Models\Country;
use App\Repositories\Contracts\CityContract;
use App\Repositories\Contracts\CountryContract;

class CityRepository extends BaseRepository implements CityContract
{
    /**
     * CountryRepository constructor.
     * @param City $model
     */
    public function __construct(City $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param City $model
     * @return int
     */
    public function relatedData(City $model)
    {
        return 0;
    }

}
