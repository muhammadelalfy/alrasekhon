<?php

namespace App\Repositories\SQL;

use App\Models\Notification;
use App\Repositories\Contracts\NotificationContract;

class NotificationRepository extends BaseRepository implements NotificationContract
{
    /**
     * NotificationRepository constructor.
     * @param Notification $model
     */
    public function __construct(Notification $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param Notification $model
     * @return int
     */
     public function relatedData(Notification $model)
     {
        return 0;
     }
}
