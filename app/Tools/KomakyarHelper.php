<?php
/**
 * Created by PhpStorm.
 * User: Mohammad
 * Date: 8/16/2017
 * Time: 12:01 AM
 */

namespace App\Tools;

use Faker\Factory;

class KomakyarHelper
{
    public static function idOrNull($model)
    {
        return is_null($model) ? $model : $model->id;
    }

    public static function thisOrNull($model, $chanceOfGettingModel = 50)
    {
        $faker = Factory::create();
        return $faker->boolean($chanceOfGettingModel) ? $model : null;
    }

    public static function appendParentAndDot($string, $parent)
    {
        if ($parent != '') {
            $string = $parent . "." . $string;
        }

        return $string;
    }

    public static function appendPrefixToArrayKeys(array $array, $prefix)
    {
        foreach ($array as $key => $value) {
            $array[$prefix . $key] = $value;
            unset($array[$key]);
        }

        return $array;
    }

    public static function appendParentToArrayKeys(array $array, $parent)
    {
        if ($parent == '') {
            return $array;
        }

        return self::appendPrefixToArrayKeys($array, $parent . '.');
    }
}