<?php

/**
 * Central Pay Plus Autoloader
 * For use when library is being used without composer
 */
//UplDevTeam
$centralpay_autoloader = function ($class_name) {
    if (strpos($class_name, 'UplDevTeam\CentralPayPlus')===0) {
        $file = dirname(__FILE__) . DIRECTORY_SEPARATOR;
        $file .= str_replace([ 'UplDevTeam\CentralPayPlus\\', '\\' ], ['', DIRECTORY_SEPARATOR ], $class_name) . '.php';
        include_once $file;
    }
};

spl_autoload_register($centralpay_autoloader);

return $centralpay_autoloader;
