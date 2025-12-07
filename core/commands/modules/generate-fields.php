<?php

use Core\Utility;

if (!isset($argv[2])) 
{
    echo "Module's name is empty\n";
    die;
}

$moduleName  = $argv[2];
$parent_path = Utility::parentPath();