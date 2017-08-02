<?php
/**
 * Created by PhpStorm.
 * User: Mohammad
 * Date: 7/27/2017
 * Time: 2:22 PM
 */

namespace App\Tools;


class PolicyHelper
{
    /**
     * Authorize a given action for the current user.
     *
     * @param  mixed $ability
     * @param  mixed|array $arguments
     * @return \Illuminate\Auth\Access\Response
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public static function authorizeApi($ability, $arguments = [])
    {
        if (!request()->user('api')->can($ability, $arguments)) {
            abort(HttpResponse::FORBIDDEN, 'This action is unauthorized.');
        }
    }
}
