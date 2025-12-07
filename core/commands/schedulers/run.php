<?php

use Core\Log;
use Core\Utility;
use Core\Scheduler;

$parent_path = Utility::parentPath();

$scheduler_name = 'scheduler-'.env('DB_NAME');

if(file_exists($parent_path . 'storage/log/'.$scheduler_name.'.txt'))
{
    die();
}

file_put_contents($parent_path . 'storage/log/'.$scheduler_name.'.txt', strtotime('now'));

try {
    // all scheduler run here
    Scheduler::run();
} catch (\Throwable $th) {
    // throw $th;
    Log::write($th->__toString());
}

unlink($parent_path . 'storage/log/'.$scheduler_name.'.txt');
die();