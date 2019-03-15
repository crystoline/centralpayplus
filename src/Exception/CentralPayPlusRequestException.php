<?php
/**
 * Created by PhpStorm.
 * User: aisha.alimi
 * Date: 19/11/2018
 * Time: 2:43 PM
 */

namespace Crystoline\CentralPayPlus\Exception;


class CentralPayPlusRequestException extends \Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}