<?php

namespace Core;

use Core\Request;
use Core\Utility;

class Bootstrap
{
    static function init()
    {
        require Utility::parentPath() . 'core/functions.php';

        // main configuration
        ini_set('display_errors', app('debug', true));
        ini_set('session.save_path', Utility::parentPath() . app('session_path', 'storage/session') );
        date_default_timezone_set(app('timezone', 'Asia/Jakarta'));

        session_start();

        // init csrf token
        if (empty($_SESSION['token'])) {
            $_SESSION['token'] = bin2hex(random_bytes(32));
        }

        // request handler
        $module = Request::getRoute();
        if($module)
        {
            $module = app('path') ? str_replace(app('path'), '', $module) : $module;
            $module = trim($module, '/');
        }
        
        if(empty($module))
        {
            $module = app('default_module') . '/index';
        }
        
        // api route
        $apiPrefix = env('API_PREFIX','api');
        $isApiRoute = startWith($module, $apiPrefix);

        // guarding or equal middleware in laravel
        Request::guarding($module, $isApiRoute);

        // csrf validation
        $routeException = Request::tokenValidationRouteException();
        if(!Request::isMethod('get') && !in_array($module, $routeException) && !$isApiRoute)
        {
            
            $validateToken = isset($_POST['_token']) && hash_equals($_SESSION['token'], $_POST['_token']);
            if(!$validateToken)
            {
                http_response_code(400);
                die('Request is invalid');
            }
        }
        
        // explode module
        $module = $isApiRoute ? str_replace($apiPrefix.'/', '', $module) : $module;
        $moduleData = explode('/', $module);
        
        // 0 => module name
        // 1 to N => process file
        $moduleName = $moduleData[0];
        
        if($isApiRoute)
        {
            $moduleData[0] = 'api';
        }
        else
        {
            unset($moduleData[0]);
        }
        $processFile = implode('/', $moduleData);

        Request::process($moduleName, $processFile);

    }
}