<?php

namespace App\Constants;

/**
 * model files constants for upload
 * constant stamp (FILE_TYPE_{model name}_{file name})
 */
enum UserTypesEnum : int
{
    case ADMIN = 1;
    case CUSTOMER = 2;
    case EMPLOYER = 3;
    case TENANT = 4;

}
