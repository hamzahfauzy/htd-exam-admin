<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");


if($_SERVER['REQUEST_METHOD'] === 'OPTIONS')
{
    http_response_code(204);
    die;
}

function my_autoloader($class) {

    // explode namespace
    $classes = explode('\\', $class);
    if(in_array($classes[0], ['Core','Modules']))
    {
        $classType = $classes[0];
        unset($classes[0]);
        if($classType == 'Core')
        {
            $importClass = '../core/src/' . implode('/',$classes);
            
        }

        else if($classType == 'Modules')
        {
            $classes[1] = strtolower($classes[1]);
            $classes[2] = strtolower($classes[2]);
            
            $importClass = '../modules/' . implode('/',$classes);
        }

        if(file_exists($importClass.'.php'))
        {
            require $importClass.'.php';
        }
        else
        {
            die($class . ' is not valid');
        }
    }
}

spl_autoload_register('my_autoloader');

\Core\Bootstrap::init();
