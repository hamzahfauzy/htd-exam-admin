<?php

use Core\Page;
use Core\Request;
use Core\Database;

Page::setTitle("Monitoring");

$today = date('Y-m-d');
$db = new Database;
$db->query = "SELECT 
    e.id,
    e.logs,
    e.user_id,
    e.schedule_id,
    u.name AS user_name,
    STR_TO_DATE(
        REPLACE(
            REPLACE(
                JSON_UNQUOTE(JSON_EXTRACT(e.logs, '$[last].time')),
                '.', ':'
            ),
            ',', ''
        ),
        '%d/%m/%Y %H:%i:%s'
    ) AS last_time
FROM exam_schedule_user_data e
LEFT JOIN users u ON u.id = e.user_id
LEFT JOIN exam_schedules exs ON exs.id = e.schedule_id
JOIN (
    SELECT 
        user_id,
        MAX(
            STR_TO_DATE(
                REPLACE(
                    REPLACE(
                        JSON_UNQUOTE(JSON_EXTRACT(logs, '$[last].time')),
                        '.', ':'
                    ),
                    ',', ''
                ),
                '%d/%m/%Y %H:%i:%s'
            )
        ) AS last_time
    FROM exam_schedule_user_data
    WHERE logs IS NOT NULL
    GROUP BY user_id
) x 
    ON x.user_id = e.user_id
   AND STR_TO_DATE(
        REPLACE(
            REPLACE(
                JSON_UNQUOTE(JSON_EXTRACT(e.logs, '$[last].time')),
                '.', ':'
            ),
            ',', ''
        ),
        '%d/%m/%Y %H:%i:%s'
    ) = x.last_time
WHERE DATE(exs.start_at) = '$today'
ORDER BY last_time DESC;
";
$logs = $db->exec('all');

Page::pushFoot("<script src='".asset('assets/exam/js/script.js?v=1.2')."'></script>");

return view('exam/views/monitoring/index', [
    'logs' => $logs
]);