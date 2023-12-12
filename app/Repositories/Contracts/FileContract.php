<?php

namespace App\Repositories\Contracts;

use App\Models\File;

interface FileContract extends BaseContract
{
    public function relatedData(File $model);
}

