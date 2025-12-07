<?php

namespace Core;

use Core\Utility;

class Response
{
    static function json($data, $message, $httpStatus = 200)
    {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($httpStatus);
        echo json_encode([
            'data' => $data,
            'message' => $message
        ]);
        die();
    }

    static function view($file, $data = [])
    {
        $parent_path = Utility::parentPath();
        $viewFile    = $parent_path . "/modules/" . $file . '.php';
        if(file_exists($viewFile))
        {
            extract($data);
            ob_start();

            require $viewFile;
            
            return ob_get_clean();
        }
        else
        {
            http_response_code(404);
            die('Error 404. '.$viewFile.' Not Found.');
        }
    }
}