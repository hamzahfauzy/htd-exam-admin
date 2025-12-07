<?php

use Core\Utility;

if (!isset($argv[2])) 
{
    echo "Module's name is empty\n";
    die;
}

$moduleName  = $argv[2];
$parent_path = Utility::parentPath();


try {
    //code...

    $file = $parent_path . 'modules/' . $moduleName . '/';
    if (file_exists($file)) {
        echo "Module exists";
        die();
    }

    // create folder
    mkdir($file);
    mkdir($file . 'assets');
    file_put_contents($file . 'assets/.gitkeep', '');

    mkdir($file . 'config');

    $contents = "<?php return [];";
    file_put_contents($file . 'config/menu.php', $contents);
    file_put_contents($file . 'config/table-fields.php', $contents);
    
    mkdir($file . 'config/lang');
    mkdir($file . 'config/lang/en');
    file_put_contents($file . 'config/lang/en/label.php', $contents);
    file_put_contents($file . 'config/lang/en/menu.php', $contents);

    mkdir($file . 'config/lang/id');
    file_put_contents($file . 'config/lang/id/label.php', $contents);
    file_put_contents($file . 'config/lang/id/menu.php', $contents);

    mkdir($file . 'databases');
    mkdir($file . 'databases/migrations');
    mkdir($file . 'databases/seeders');
    file_put_contents($file . 'databases/seeders/.gitkeep', '');
    mkdir($file . 'guards');
    file_put_contents($file . 'guards/.gitkeep', '');
    mkdir($file . 'hooks');
    file_put_contents($file . 'hooks/.gitkeep', '');
    mkdir($file . 'libraries');
    file_put_contents($file . 'libraries/.gitkeep', '');
    mkdir($file . 'process');
    file_put_contents($file . 'process/.gitkeep', '');
    mkdir($file . 'views');
    file_put_contents($file . 'views/.gitkeep', '');

    echo "Module ". $moduleName ." created successfuly\n";
} catch (\Throwable $th) {
    echo "Module ". $moduleName ." created failed\n";
    throw $th;
}
