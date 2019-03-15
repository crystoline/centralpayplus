<?php
namespace Crystoline\CentralPayPlus\Helpers;

use \Closure;
use \Crystoline\CentralPayPlus\Contracts\RouteInterface;
use \Crystoline\CentralPayPlus\Http\RequestBuilder;

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
