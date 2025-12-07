<?php

namespace Core;

class Log
{
    static function write($log)
    {
        $date = date('Y-m-d');
        $file = Utility::parentPath() . 'storage/log/' . $date . '.log';

        if(file_exists($file))
        {
            file_put_contents($file, $log.PHP_EOL, FILE_APPEND);
        }
        else
        {
            file_put_contents($file, $log.PHP_EOL);
        }
    }
}