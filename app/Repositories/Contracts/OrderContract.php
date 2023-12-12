<?php

namespace App\Repositories\Contracts;

use App\Models\Order;

interface OrderContract extends BaseContract
{
    public function relatedData(Order $model);
}

