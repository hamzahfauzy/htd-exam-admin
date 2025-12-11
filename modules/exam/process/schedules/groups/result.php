<?php

use Core\Page;
use Core\Database;

$schedule_group_id = $_GET['schedule_group_id'];
$db = new Database;

$db->query = "SELECT * FROM exam_schedules WHERE id = (SELECT schedule_id FROM exam_schedule_groups WHERE id = $schedule_group_id)";
$schedule = $db->exec('single');

$db->query = "SELECT * FROM exam_groups WHERE id = (SELECT group_id FROM exam_schedule_groups WHERE id = $schedule_group_id)";
$group = $db->exec('single');

// page section
$title = "Hasil ".$schedule->name.' - '. $group->name;
Page::setTitle($title);
Page::setBreadcrumbs([
    [
        'url' => routeTo('/'),
        'title' => __('crud.label.home')
    ],
    [
        'url' => routeTo('crud/index', ['table' => 'exam_schedules']),
        'title' => __('exam.label.schedule')
    ],
    [
        'url' => routeTo('crud/index', ['table' => 'exam_schedule_groups', 'filter' => ['schedule_id'=> $schedule->id]]),
        'title' => $schedule->name .' - '. $group->name
    ],
    [
        'title' => 'Hasil'
    ]
]);


$db->query = "SELECT 
                    users.id, 
                    users.name,
                    exam_schedules.id schedule_id,
                    exam_schedule_user_data.status `status`,
                    CASE WHEN exam_schedule_user_data.answers IS NOT NULL THEN 'OK' else 'NOT OK' END answer_status,
                    exam_schedule_user_data.logs,
                    ((SELECT SUM(score) FROM exam_member_answers WHERE exam_member_answers.user_id = users.id AND exam_member_answers.schedule_id = exam_schedules.id)/exam_schedules.question_showed)*100 as final_score
                FROM 
                    users 
                JOIN
                    exam_schedule_groups ON exam_schedule_groups.id = $schedule_group_id
                JOIN
                    exam_schedules ON exam_schedules.id = exam_schedule_groups.schedule_id
                JOIN
                    exam_schedule_user_data ON exam_schedule_user_data.user_id = users.id AND exam_schedule_user_data.schedule_id = exam_schedules.id
                WHERE 
                    users.id IN (SELECT user_id FROM exam_group_member WHERE group_id = exam_schedule_groups.group_id)";
$member = $db->exec('all');

Page::pushFoot("<script src='".asset('assets/exam/js/script.js')."'></script>");

return view('exam/views/schedules/groups/result', compact('title', 'member', 'group'));