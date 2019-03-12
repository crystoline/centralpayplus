<?php

namespace UplDevTeam\CentralPayPlus\Exception;

use UplDevTeam\CentralPayPlus\Exception\CentralPayPlusRequestException;

class ValidationException extends CentralPayPlusRequestException
{
    public $errors;
    public function __construct($message, array $errors = [])
    {
        parent::__construct($message);
        $this->errors = $errors;
    }
}
