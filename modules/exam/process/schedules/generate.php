<?php

use Core\Utility;
use Core\Database;

$schedule_id = $_GET['schedule_id'];

generateQuestionSchedule($schedule_id, false);

set_flash_msg(['success'=>"Berhasil generate"]);

header('location:'.routeTo('crud/index',[
    'table' => 'exam_schedules'
]));
die();