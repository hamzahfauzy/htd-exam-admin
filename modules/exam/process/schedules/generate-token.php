<?php

use Core\Database;

$schedule_id = $_GET['schedule_id'];
$db    = new Database;
$token = strtoupper(substr(md5(strtotime('now')), 0, 6));

$db->update('exam_schedules', [
    'token' => $token
], [
    'id' => $schedule_id
]);

set_flash_msg(['success'=>"Token Berhasil di generate"]);

header('location:'.routeTo('crud/index',[
    'table' => 'exam_schedules'
]));
die();