<?php

namespace App\Repositories\Contracts;

use App\Models\OrderItem;

interface OrderItemContract extends BaseContract
{
    public function relatedData(OrderItem $model);
}

