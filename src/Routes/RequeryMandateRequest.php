<?php
/**
 * Created by PhpStorm.
 * User: aisha.alimi
 * Date: 21/11/2018
 * Time: 10:27 AM
 */

namespace UplDevTeam\CentralPayPlus\Routes;


use UplDevTeam\CentralPayPlus\Contracts\RouteInterface;

class RequeryMandateRequest implements RouteInterface
{

    public static function getMethodName () : string
    {
        // TODO: Implement getMethodName() method.
        return 'requeryMandateRequest';
    }

    public static function requiredParams (): bool
    {
        // TODO: Implement requiredParams() method.
        return true;
    }

    public static function paramsValidationRules (): mixed
    {
        // TODO: Implement paramsValidationRules() method.
        return [
            'MandateCode',
            'BillerID',
        ];
    }
}