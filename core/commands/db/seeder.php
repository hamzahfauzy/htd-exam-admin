<?php

use Core\Utility;
use Core\Database;

$parent_path = Utility::parentPath();

$db    = new Database();
$seederFile = $argv[2];

try {
    //code...

    $file = $parent_path . 'modules/' . $seederFile. '.sql';
    if(!file_exists($file))
    {
        echo "File doesn't exists";
        die();
    }

    $myfile = fopen($file, "r") or die("Unable to open file!");
    $query  = fread($myfile,filesize($parent_path . $file));
    fclose($myfile);
    
    $db->query = $query;
    $db->exec('multi_query');

    echo "File $file: Seeder Success\n";

} catch (\Throwable $th) {
    throw $th;
}