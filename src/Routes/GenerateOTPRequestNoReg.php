<?php
/**
 * Created by PhpStorm.
 * User: aisha.alimi
 * Date: 21/11/2018
 * Time: 10:27 AM
 */

namespace Crystoline\CentralPayPlus\Routes;


use Crystoline\CentralPayPlus\Contracts\RouteInterface;

class GenerateOTPRequestNoReg implements RouteInterface
{

    public static function getMethodName () : string
    {
        return 'generateOTPRequestNoReg';
    }

    public static function requiredParams (): bool
    {
        return true;
    }

    public static function paramsValidationRules (): array
    {
        return [
            'AcctNumber',
            'AcctName',
            'TransType',
            'BankCode',
            'BillerID',
            'BillerName',
            'Amount',
            'BillerTransId',
            'HashValue',
        ];
    }

    public static function parameterType(): string
    {
       return 'array';
    }
}