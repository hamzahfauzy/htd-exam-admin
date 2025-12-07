<?php

namespace Core;

class Menu 
{
    private $module;
    private $menu;
    
    function __construct($module, $menu)
    {
        $this->menu = $menu;
        $this->module = $module;
    }

    function getMenu()
    {
        return $this->menu;
    }

    function getModule()
    {
        return $this->module;
    }
}