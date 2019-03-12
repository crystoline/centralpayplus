<?php
namespace UplDevTeam\CentralPayPlus\Contracts;

interface RouteInterface
{

    const METHOD_KEY = 'method';
    const ENDPOINT_KEY = 'endpoint';
    const PARAMS_KEY = 'params';
    const ARGS_KEY = 'args';
    const REQUIRED_KEY = 'required';
    const POST_METHOD = 'post';
    const PUT_METHOD = 'put';
    const GET_METHOD = 'get';

    /**
     * @return mixed
     */
    public static function getMethodName() : string ;

    public static function parameterType(): string ;

    /**
     * @return bool
     */
    public static function requiredParams() : bool ;

    public static function paramsValidationRules(): array ;
}
