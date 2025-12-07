<?php

use Core\Page;
use Core\Utility;

function get_title()
{
    echo Page::get_title();
}

function head_script()
{
    echo Page::head_script();
}

function foot_script()
{
    echo Page::foot_script();
}

function get_header()
{
    $parent_path = Utility::parentPath();
    $active_theme = app('theme');
    $viewFile    = $parent_path . "/themes/$active_theme/header.php";
    echo loadFile($viewFile);
}

function get_footer()
{
    $parent_path = Utility::parentPath();
    $active_theme = app('theme');
    $viewFile    = $parent_path . "/themes/$active_theme/footer.php";
    echo loadFile($viewFile);
}

function get_sidebar()
{
    $parent_path = Utility::parentPath();
    $active_theme = app('theme');
    $viewFile    = $parent_path . "/themes/$active_theme/sidebar.php";
    echo loadFile($viewFile);
}

function get_nav()
{
    $parent_path = Utility::parentPath();
    $active_theme = app('theme');
    $viewFile    = $parent_path . "/themes/$active_theme/nav.php";
    echo loadFile($viewFile);
}

function get_menu()
{
    return Page::get_menu();
}

function get_module_name()
{
    return Page::get_module_name();
}

function get_breadcrumbs()
{
    return Page::get_breadcrumbs();
}

function getActive()
{
    return Page::$active;
}

function loadFile($file)
{
    if(file_exists($file))
    {
        ob_start();

        require $file;
        
        return ob_get_clean();
    }

    return "";
}

function including($file)
{
    $parent_path = Utility::parentPath();
    $file = $parent_path . "/" . $file . ".php";
    if(file_exists($file))
    {
        ob_start();

        require $file;
        
        return ob_get_clean();
    }

    return "";
}