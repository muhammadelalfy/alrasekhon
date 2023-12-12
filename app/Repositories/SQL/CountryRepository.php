<?php

namespace App\Repositories\SQL;

use App\Models\Country;
use App\Repositories\Contracts\CountryContract;

class CountryRepository extends BaseRepository implements CountryContract
{
    /**
     * CountryRepository constructor.
     * @param Country $model
     */
    public function __construct(Country $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param Country $model
     * @return int
     */
     public function relatedData(Country $model)
     {
        return 0;
     }
}
