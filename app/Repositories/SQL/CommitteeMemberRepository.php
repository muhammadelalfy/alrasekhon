<?php

namespace App\Repositories\SQL;

use App\Models\CommitteeMember;
use App\Repositories\Contracts\CommitteeMemberContract;

class CommitteeMemberRepository extends BaseRepository implements CommitteeMemberContract
{
    /**
     * CommitteeMemberRepository constructor.
     * @param CommitteeMember $model
     */
    public function __construct(CommitteeMember $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param CommitteeMember $model
     * @return int
     */
     public function relatedData(CommitteeMember $model)
     {
        return 0;
     }
}
