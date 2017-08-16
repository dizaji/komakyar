<?php
/**
 * Created by PhpStorm.
 * User: Mohammad
 * Date: 8/16/2017
 * Time: 12:01 AM
 */

namespace App\Tools;


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

    public static function stringifyArrayForValidation($array)
    {
        $result = "";
        foreach ($array as $value) {
            $result .= (strlen($result) > 0 ? "," : "");
            $result .= $value;
        }
        return $result;
    }
}