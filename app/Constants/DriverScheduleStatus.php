<?php
namespace App\Constants;

enum DriverScheduleStatus
{
    case PAST;
    case CURRENT;
    case UPCOMING;

    public function text(): string
    {
        return match($this)
        {
            self::PAST => __("Past"),
            self::CURRENT => __("Current"),
            self::UPCOMING => __("Upcoming"),
        };
    }

    public function style(): string
    {
        return match($this)
        {
            self::PAST => 'danger',
            self::CURRENT => 'success',
            self::UPCOMING => 'warning',
        };
    }
}
