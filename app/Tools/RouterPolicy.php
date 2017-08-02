<?php
/**
 * Created by PhpStorm.
 * User: Mohammad
 * Date: 7/6/2017
 * Time: 3:36 PM
 */

namespace App\Tools;


class RouterPolicy
{
    private $route_name;
    private $route_parameters;
    private $policy_name;
    private $policy_parameters;

    /**
     * RouterPolicy constructor.
     * this will help to generate routes according to policies.
     * if $policy_name equal to false then it will ignore policy.
     *
     * @param string $route_name
     * @param array $route_parameters
     * @param string|bool $policy_name
     * @param array|null $policy_parameters
     */
    function __construct($route_name, $route_parameters, $policy_name = false, $policy_parameters = null)
    {
        $this->setRouteName($route_name)
            ->setRouteParameters($route_parameters)
            ->setPolicyName($policy_name)
            ->setPolicyParameters($policy_parameters);
    }

    ////////////////////////////////////////
    ///       Setter and Getters
    ////////////////////////////////////////

    /**
     * @return string
     */
    public function getRouteName()
    {
        return $this->route_name;
    }

    /**
     * @param string $route_name
     * @return $this
     */
    public function setRouteName($route_name)
    {
        $this->route_name = $route_name;
        return $this;
    }

    /**
     * @return array
     */
    public function getRouteParameters()
    {
        return $this->route_parameters;
    }

    /**
     * @param array $route_parameters
     * @return $this
     */
    public function setRouteParameters($route_parameters)
    {
        $this->route_parameters = $route_parameters;
        return $this;
    }

    /**
     * @return string|boolean
     */
    public function getPolicyName()
    {
        return $this->policy_name;
    }

    /**
     * @param string|boolean $policy_name
     * @return $this
     */
    public function setPolicyName($policy_name)
    {
        $this->policy_name = $policy_name;
        return $this;
    }

    /**
     * @return array
     */
    public function getPolicyParameters()
    {
        return $this->policy_parameters;
    }

    /**
     * @param array $policy_parameters
     * @return $this
     */
    public function setPolicyParameters($policy_parameters)
    {
        $this->policy_parameters = $policy_parameters;
        return $this;
    }

    ////////////////////////////////////////
    ///              Logic
    ////////////////////////////////////////

    /**
     * this method will return the route if user is authorised  or $policy_name is equal to false
     * else return null
     *
     * @return null|string
     */
    public function generateRoute()
    {
        if (!$this->getPolicyName() || request()->user()->can($this->getPolicyName(), $this->getPolicyParameters())) {
            return route($this->getRouteName(), $this->getRouteParameters());
        } else {
            return null;
        }
    }

    /**
     * A method to generate routes and policy for each object
     *
     * @param object $object Models
     * @param array $routerPolicies
     * @return object
     */
    public static function getRoutes($object, $routerPolicies)
    {
        foreach ($routerPolicies as $routerPolicy) {
            $object->routes[$routerPolicy->getRouteName()] = $routerPolicy->generateRoute();
        }

        return $object;
    }
}
