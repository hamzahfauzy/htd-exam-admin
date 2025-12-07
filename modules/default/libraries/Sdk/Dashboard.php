<?php

namespace Modules\Default\Libraries\Sdk;

class Dashboard 
{

    private static $components  = [];

    static function add($components)
    {
        self::$components[] = $components;
    }

    static function render()
    {
        $contents = [];
        foreach(self::$components as $component)
        {
            try {
                //code...
                if(is_callable($component))
                {
                    $contents[] = $component();
                }

                else if(is_string($component))
                {
                    $contents[] = ($component)();
                }
            } catch (\Throwable $th) {
                //throw $th;
            }
        }

        return implode('', $contents);
    }

}