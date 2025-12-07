<?php

use Core\Request;
use Core\Database;
use Core\Response;

$schedule_id = $_GET['schedule_id'];
$db = new Database;
$schedule = $db->single('exam_schedules',[
    'id' => $schedule_id,
]);

if($schedule)
{
    if(Request::isMethod('POST'))
    {
        // delete existing answer
        $db->delete('exam_member_answers', [
            'schedule_id' => $schedule_id,
            'user_id' => auth()->id
        ]);
        // save jawaban
        $answers = isset($_POST['answer']) ? $_POST['answer'] : [];
        $db->query = "UPDATE exam_schedule_user_data SET `status` = 'DONE', answers = ? WHERE schedule_id = $schedule_id AND user_id = ". auth()->id;
        $db->exec(false, [json_encode($answers)]);

        return Response::json([], 'Ujian telah selesai');
    }

    $now = strtotime('now');
    $startAt = strtotime($schedule->start_at);
    $endAt = strtotime($schedule->end_at);
    $is_finished = $now > $endAt;
    $schedule_user_data = $db->single('exam_schedule_user_data', [
        'schedule_id' => $schedule_id,
        'user_id'     => auth()->id
    ]);
    
    if($schedule_user_data)
    {        
        $schedule_user_data->data = json_decode($schedule_user_data->data);

        if(!$schedule_user_data->status)
        {
            $db->update('exam_schedule_user_data', [
                'status' => 'ON PROGRESS'
            ], [
                'schedule_id' => $schedule_id,
                'user_id'     => auth()->id
            ]);
        }

        return Response::json(compact('schedule_user_data','schedule','is_finished'), 'data retrieved');
    }
}

return Response::json([], "Maaf! Data tidak valid", 403);
