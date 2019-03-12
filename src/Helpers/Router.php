<?php

namespace UplDevTeam\CentralPayPlus\Helpers;

use \Closure;
use \UplDevTeam\CentralPayPlus\Contracts\RouteInterface;
use \UplDevTeam\CentralPayPlus\Exception\ValidationException;

class Router
{
    private $route;
    private $route_class;
    private $methods;
    private $requestObj;
    public static $ROUTES  = [
        'createMandateRequest',
        'validateOTPRequest',
        'generateOTPRequest',
        'cancelMandateRequest',
        'requeryMandateRequest',
        'listActiveBanks',
        'listActiveBanksOTP'
    ];


    public function __call($methd, $sentargs)
    {
        $method = ($methd === 'list' ? 'getList' : $methd );
        if (array_key_exists($method, $this->methods) && is_callable($this->methods[$method])) {
            return call_user_func_array($this->methods[$method], $sentargs);
        } else {
            throw new \Exception('Function "' . $method . '" does not exist for "' . $this->route . '".');
        }
    }

    public function __construct($route, $requestObj)
    {
        if (!in_array($route, Router::$ROUTES)) {
            throw new ValidationException(
                "Route '{$route}' does not exist."
            );
        }

        $this->route = $route;
        $this->route_class = 'UplDevTeam\\CentralPayPlus\\Routes\\' . ucwords($route);

        $mets = get_class_methods($this->route_class);

        if (empty($mets)) {
            throw new \InvalidArgumentException('Class "' . $this->route . '" does not exist.');
        }
        // add methods to this object per method, except root

        // Todo: Validate request object againist rules
        $this->requestObj = $requestObj;

    }

    public function generateRequest(){
        $caller = new Caller($this->requestObj);
        return $caller->callEndpoint(call_user_func($this->route_class . '::' . 'getMethodName'));
    }
}
