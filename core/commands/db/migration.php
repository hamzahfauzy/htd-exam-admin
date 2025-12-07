<?php

use Core\Utility;
use Core\Database;

$parent_path = Utility::parentPath();

$db    = new Database();
$isFreshFlag = isset($argv[2]) ? $argv[2] : '';

try {
    if($isFreshFlag == '--fresh')
    {
        $query = "SELECT CONCAT('DROP TABLE IF EXISTS `', table_name, '`;') as _query
        FROM information_schema.tables
        WHERE table_schema = '".env('DB_NAME')."'";
        $db->query = $query;
        $allDbName = $db->exec('all');

        foreach($allDbName as $q)
        {
            $db->query = "SET foreign_key_checks = 0;".$q->_query;
            $db->exec('multi_query');
        }
    }
    
    $query = "CREATE TABLE IF NOT EXISTS migrations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        filename VARCHAR(100) NOT NULL,
        execute_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
    )";
    $db->query = $query;
    $db->exec();

} catch (\Throwable $th) {
    echo "Initiation error\n";
    throw $th;
}

$modules = getModules();

$isRun = false;

foreach($modules as $module)
{
    try {
        //code...
        $folder = $module . "/databases/migrations";
        if(!file_exists($folder)) continue;
        $files = preg_grep('~^migration-.*\.sql$~', scandir($parent_path . $folder));
        
        if(!empty($files))
        {
            $files = array_map(function($file) use ($folder){
                return $folder . '/' . $file;
            }, $files);
    
            $all_migrations = $db->all('migrations',[
                'filename' => ['in','("'.implode('","',$files).'")']
            ]);
        
            $all_migrations = array_map(function($migration){
                return $migration->filename;
            }, $all_migrations);
        
            foreach($files as $file)
            {
                if(in_array($file, $all_migrations)) continue;
        
                $myfile = fopen($parent_path . $file, "r") or die("Unable to open file!");
                $query  = fread($myfile,filesize($parent_path . $file));
                fclose($myfile);
                
                $db->query = $query;
                $db->exec('multi_query');
        
                $db->insert('migrations',[
                    'filename' => $file
                ]);

                $isRun = true;
                
                echo "File $file: Migration Success\n";
            }
        
        }
    } catch (\Throwable $th) {
        echo "Module : ".$module."\n";
        throw $th;
    }
}

if(!$isRun)
{
    echo "Nothing to migrate\n";
}