<?php

namespace App\Repositories\SQL;

use App\Models\OrderItem;
use App\Repositories\Contracts\OrderItemContract;

class OrderItemRepository extends BaseRepository implements OrderItemContract
{
    /**
     * OrderItemRepository constructor.
     * @param OrderItem $model
     */
    public function __construct(OrderItem $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param OrderItem $model
     * @return int
     */
     public function relatedData(OrderItem $model)
     {
        return 0;
     }
}
