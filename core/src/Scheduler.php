<?php

namespace Core;

use Core\Utility;

class Scheduler
{
    private static $scripts = [];
    static function register($file)
    {
        self::$scripts[] = $file;
    }

    static function run()
    {
        $parent_path = Utility::parentPath();
        
        foreach(self::$scripts as $script)
        {
            if(file_exists($parent_path . "modules/$script.php"))
            {
                try {
                    //code...
                    require $parent_path . "modules/$script.php";
                } catch (\Throwable $th) {
                    Log::write($th->__toString());
                    //throw $th;
                }
            }
        }
    }
}