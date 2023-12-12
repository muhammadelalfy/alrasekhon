<?php

namespace App\Repositories\Contracts;

use App\Models\CommitteeMember;

interface CommitteeMemberContract extends BaseContract
{
    public function relatedData(CommitteeMember $model);
}

