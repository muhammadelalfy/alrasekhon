<?php

namespace App\Repositories\SQL;

use App\Models\Item;
use App\Repositories\Contracts\ItemContract;

class ItemRepository extends BaseRepository implements ItemContract
{
    /**
     * ItemRepository constructor.
     * @param Item $model
     */
    public function __construct(Item $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param Item $model
     * @return int
     */
     public function relatedData(Item $model)
     {
        return 0;
     }
}
