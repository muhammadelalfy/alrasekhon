<?php

namespace App\Constants;

/**
 * model files constants for upload
 * constant stamp (FILE_TYPE_{model name}_{file name})
 */
enum FileConstants
{
    case FILE_TYPE_USER_AVATAR;
    case FILE_TYPE_DRIVER_AVATAR;

    public function value(): string
    {
        return match($this)
        {
            self::FILE_TYPE_USER_AVATAR => "user_avatar",
            self::FILE_TYPE_DRIVER_AVATAR => "driver_avatar",
        };
    }
}
