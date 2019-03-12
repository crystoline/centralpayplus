<?php
namespace UplDevTeam\CentralPayPlus\Helpers;

use \Closure;
use \UplDevTeam\CentralPayPlus\Contracts\RouteInterface;
use \UplDevTeam\CentralPayPlus\Http\RequestBuilder;

class Caller
{
    private $requestObj;

    public function __construct($requestObj)
    {
        $this->requestObj = $requestObj;
    }

    public function callEndpoint($method)
    {
        $builder = new RequestBuilder($method, $this->requestObj);
        return $builder->build();
    }
}
