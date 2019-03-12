<?php
/**
 * Created by PhpStorm.
 * User: aisha.alimi
 * Date: 21/11/2018
 * Time: 10:27 AM
 */

namespace UplDevTeam\CentralPayPlus\Routes;


use UplDevTeam\CentralPayPlus\Contracts\RouteInterface;

class ListActiveBanksOTP implements RouteInterface
{

    public static function getMethodName () : string
    {
        // TODO: Implement getMethodName() method.
        return 'listActiveBanksOTP';
    }

    public static function requiredParams (): bool
    {
        // TODO: Implement requiredParams() method.
        return true;
    }

    public static function paramsValidationRules (): array
    {
        // TODO: Implement paramsValidationRules() method.
        return [];
    }

    public static function parameterType (): string
    {
        // TODO: Implement parameterType() method.
        return 'string';
    }
}