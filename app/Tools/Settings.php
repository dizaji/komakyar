<?php
/**
 * Created by PhpStorm.
 * User: Mohammad
 * Date: 7/24/2017
 * Time: 3:47 PM
 */

namespace App\Tools;


class Settings
{
    const VAT = 9;
    const PAGINATION_LIMIT_API = 25;
    const PAGINATION_LIMIT_STAFF = 25;
    const PAGINATION_LIMIT_ADMIN = 25;
    const PAGINATION_LIMIT_API_CHILDREN = 10;

    const LOAD_LIMIT = 10;

    const PARENT_LIMIT = self::LOAD_LIMIT;
    const GROUP_STUDENT_LIMIT = self::LOAD_LIMIT;
    const STUDENT_LOAD_LIMIT = self::LOAD_LIMIT;
}
