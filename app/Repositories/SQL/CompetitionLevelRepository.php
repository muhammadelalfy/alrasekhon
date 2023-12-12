<?php

namespace App\Repositories\SQL;

use App\Models\CompetitionLevel;
use App\Repositories\Contracts\CompetitionLevelContract;

class CompetitionLevelRepository extends BaseRepository implements CompetitionLevelContract
{
    /**
     * CompetitionLevelRepository constructor.
     * @param CompetitionLevel $model
     */
    public function __construct(CompetitionLevel $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param CompetitionLevel $model
     * @return int
     */
     public function relatedData(CompetitionLevel $model)
     {
        return 0;
     }

     public function storeLevel($params){
         if (!empty($params)) {
             $filtered = $this->cleanUpAttributes($params);
             $model1 = $this->query->create($filtered);
             $collection[] = $model1;
             if (isset($params['rows'])) {
                 $rows = $params['rows'];
             }
             return $collection;
         }
     }
}
