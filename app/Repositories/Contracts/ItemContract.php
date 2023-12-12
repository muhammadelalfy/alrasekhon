<?php

namespace App\Repositories\Contracts;

use App\Models\Item;

interface ItemContract extends BaseContract
{
    public function relatedData(Item $model);
}

