<?php
/**
 * Created by PhpStorm.
 * User: aisha.alimi
 * Date: 21/11/2018
 * Time: 10:27 AM
 */

namespace Crystoline\CentralPayPlus\Routes;


use Crystoline\CentralPayPlus\Contracts\RouteInterface;

class CancelMandateRequest implements RouteInterface
{

    public static function getMethodName () : string
    {
        // TODO: Implement getMethodName() method.
        return 'cancelMandateRequest';
    }

    public static function requiredParams (): bool
    {
        // TODO: Implement requiredParams() method.
        return true;
    }

    public static function paramsValidationRules (): array
    {
        // TODO: Implement paramsValidationRules() method.
        return [
            'MandateCode',
            'TransType',
            'BankCode',
            'BillerID',
            'BillerName',
            'BillerTransId'
        ];
    }
}