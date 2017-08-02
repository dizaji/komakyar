<?php
/**
 * Created by PhpStorm.
 * User: Mohammad
 * Date: 7/27/2017
 * Time: 2:25 PM
 */

namespace App\Tools;


trait ApiTrait
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
    public function authorizeApi($ability, $arguments)
    {
        return PolicyHelper::authorizeApi($ability, $arguments);
    }
}
