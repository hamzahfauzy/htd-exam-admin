<?php

use Core\Database;

$user_id = $_GET['user_id'];
$schedule_id = $_GET['schedule_id'];
$db = new Database;

$db->query = "DELETE FROM exam_member_answers WHERE schedule_id = $schedule_id AND user_id = $user_id;";
$db->query .= "UPDATE exam_schedule_user_data SET `status` = NULL WHERE schedule_id = $schedule_id AND user_id = $user_id;";
$db->exec('multi_query');

$user_group = $db->single('exam_group_member',[
    'user_id' => $user_id
]);

$db->query = "SELECT * FROM exam_schedule_groups WHERE schedule_id = $schedule_id AND group_id = (SELECT group_id FROM exam_group_member WHERE user_id = $user_id)";
$exam_schedule_group = $db->exec('single');

set_flash_msg(['success'=>"Reset ujian berhasil"]);

header('location:'.routeTo('exam/schedules/groups/result',[
    'schedule_group_id' => $exam_schedule_group->id
]));
die();