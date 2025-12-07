<?php

use Core\Database;

$db = new Database;
$db->query = "SELECT * FROM exam_schedules WHERE NOT EXISTS (SELECT schedule_id FROM exam_schedule_user_data WHERE exam_schedule_user_data.schedule_id = exam_schedules.id)";
$schedules = $db->exec('all');

foreach($schedules as $schedule)
{
    generateQuestionSchedule($schedule->id);
}