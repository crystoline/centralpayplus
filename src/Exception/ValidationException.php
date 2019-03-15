<?php

namespace Crystoline\CentralPayPlus\Exception;

use Crystoline\CentralPayPlus\Exception\CentralPayPlusRequestException;

class ValidationException extends CentralPayPlusRequestException
{
    public $errors;
    public function __construct($message, array $errors = [])
    {
        parent::__construct($message);
        $this->errors = $errors;
    }
}
