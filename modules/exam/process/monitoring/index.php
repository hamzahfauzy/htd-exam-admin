<?php

use Core\Page;
use Core\Request;
use Core\Database;

Page::setTitle("Monitoring");

$today = date('Y-m-d');
$db = new Database;
$db->query = "SELECT e.id, e.logs, e.user_id, e.schedule_id, u.name AS user_name, JSON_UNQUOTE(JSON_EXTRACT(e.logs, '$[last].time')) AS last_time
                FROM exam_schedule_user_data e
                LEFT JOIN users u ON u.id = e.user_id
                LEFT JOIN exam_schedules exs ON exs.id = e.schedule_id
                JOIN (
                    SELECT 
                        user_id,
                        MAX(JSON_UNQUOTE(JSON_EXTRACT(logs, '$[last].time'))) AS last_time
                    FROM exam_schedule_user_data
                    WHERE logs IS NOT NULL
                    GROUP BY user_id
                ) x ON x.user_id = e.user_id
                AND JSON_UNQUOTE(JSON_EXTRACT(e.logs, '$[last].time')) = x.last_time
                AND exs.start_at LIKE '%$today%'
                ORDER BY e.id DESC";
$logs = $db->exec('all');

Page::pushFoot("<script src='".asset('assets/exam/js/script.js')."'></script>");

return view('exam/views/monitoring/index', [
    'logs' => $logs
]);