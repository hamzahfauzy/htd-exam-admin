<?php

namespace Core;

class Page 
{
    static $active;
    static $title;
    static $head = [];
    static $foot = [];
    static $moduleName = "";
    static $breadcrumbs = [];

    static function setModuleName($name)
    {
        self::$moduleName = $name;
    }

    static function setActive($name)
    {
        self::$active = $name;
    }

    static function setBreadcrumbs($data)
    {
        self::$breadcrumbs = $data;
    }

    static function pushHead($str)
    {
        self::$head[] = $str;
    }
    
    static function pushFoot($str)
    {
        self::$foot[] = $str;
    }

    static function setTitle($title)
    {
        self::set_title($title);
    }

    static function set_title($title)
    {
        self::$title = $title;
    }

    static function get_title()
    {
        return self::$title;
    }

    static function head_script()
    {
        echo implode('', self::$head);
    }
    
    static function foot_script()
    {
        echo implode('', self::$foot);
    }

    static function get_menu()
    {
        $menus = [];
        $modules = getModules();
        $parent_path = Utility::parentPath();
        $userId = auth()->id;
        foreach($modules as $module)
        {
            $menuFile = $parent_path . $module . "/config/menu.php";
            if(file_exists($menuFile))
            {
                $menuData = require $menuFile;
                $allowedMenu = [];
                foreach($menuData as $menu)
                {
                    if(isset($menu['route']))
                    {
                        $path = parsePath($menu['route']);
                        if(is_allowed($path, $userId))
                        {
                            $allowedMenu[] = $menu;
                        }
                    }
                    else
                    {
                        $allowedItems = [];
                        if(isset($menu['items']))
                        {
                            foreach($menu['items'] as $item)
                            {
                                if(isset($item['route']))
                                {
                                    $path = parsePath($item['route']);
                                    if(is_allowed($path, $userId))
                                    {
                                        $allowedItems[] = $item;
                                    }
                                }
                            }

                            $menu['items'] = $allowedItems;
                        }

                        if($allowedItems)
                        {
                            $allowedMenu[] = $menu;
                        }
                    }
                    
                }

                if($allowedMenu)
                {
                    $menus[] = [
                        'moduleName' => str_replace('modules/','',$module),
                        'menu' => $allowedMenu
                    ];
                }
            }
        }

        return $menus;
    }

    static function get_module_name()
    {
        return self::$moduleName;
    }

    static function get_breadcrumbs()
    {
        return self::$breadcrumbs;
    }

    /**
     * for inject hooks file from other file
     */
    static function pushHook($page = 'index')
    {
        // echo self::$active;
        // [0] => moduleName, [1] => tableName
        $active = explode('.', self::$active);
        $parent_path = Utility::parentPath();
        $hookFile = $parent_path . "modules/". $active[0] . "/hooks/push-hook-".$page."-".$active[1].".php";

        if(file_exists($hookFile))
        {
            require $hookFile;
        }
    }
}