<?php
namespace Core;

class Event {

    static $events = [];

    static function register($event, $callback)
    {
        if(!isset(self::$events[$event]))
        {
            self::$events[$event] = [];
        }

        self::$events[$event][] = $callback;
    }

    static function trigger($event, $param)
    {
        if(isset(self::$events[$event]))
        {
            foreach(self::$events[$event] as $callback)
            {
                try {
                    //code...
                    if(is_callable($callback))
                    {
                        $callback($param);
                        continue;
                    }

                    if(is_string($callback))
                    {
                        ($callback)($param);
                        continue;
                    }
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
        }
    }
}