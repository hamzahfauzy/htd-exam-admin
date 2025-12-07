<?php

use Core\Request;
use Core\Database;
use Core\Response;

$schedule_id = $_GET['schedule_id'];
$db = new Database;

$userData = $db->single('exam_schedule_user_data', [
    'schedule_id' => $schedule_id,
    'user_id' => auth()->id
]);

$logs = json_decode($_POST['logs'], 1);
$newLog = array_merge(json_decode($userData->logs,1) ?? [], $logs);

$db->query = "UPDATE exam_schedule_user_data SET logs = ? WHERE schedule_id = $schedule_id AND user_id = ". auth()->id;
$db->exec(false, [json_encode($newLog)]);

return Response::json([], 'Log tersimpan');