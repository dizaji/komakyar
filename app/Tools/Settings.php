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
    const PAGINATION_LIMIT_STAFF = 10;
    const PAGINATION_LIMIT_ADMIN = 25;
    const PAGINATION_LIMIT_API_CHILDREN = 10;

    const PAGINATION_GROUP_LIMIT = self::PAGINATION_LIMIT_STAFF;
    const PAGINATION_TEACHERS_LIMIT = self::PAGINATION_LIMIT_STAFF;
    const PAGINATION_GROUP_STUDENT_LIMIT = self::PAGINATION_LIMIT_STAFF;
    const PAGINATION_COURSE_SOURCE_LIMIT = self::PAGINATION_LIMIT_STAFF;

    const LOAD_UNLIMIT = 50;

    const LOAD_LIMIT = 10;
    const PARENT_LIMIT = self::LOAD_LIMIT;
    const GROUP_STUDENT_LIMIT = self::LOAD_LIMIT;
    const STUDENT_LOAD_LIMIT = self::LOAD_LIMIT;
}
