<?php

use Core\Database;

$db = new Database;

$db->query = "SELECT 
            exam_schedule_user_data.* 
        FROM 
            exam_schedule_user_data 
        WHERE 
            exam_schedule_user_data.answers IS NOT NULL AND
            exam_schedule_user_data.status = 'DONE' AND
            (SELECT COUNT(*) FROM exam_member_answers WHERE exam_member_answers.schedule_id = exam_schedule_user_data.schedule_id AND exam_member_answers.user_id = exam_schedule_user_data.user_id) = 0
";

$user_data = $db->exec('all');

foreach($user_data as $schedule_user_data)
{
    $user_id     = $schedule_user_data->user_id;
    $schedule_id = $schedule_user_data->schedule_id;
    // soal
    $data = json_decode($schedule_user_data->data);
        
    // save jawaban
    $answers = json_decode($schedule_user_data->answers, true);
    $query   = "DELETE FROM exam_member_answers WHERE schedule_id = $schedule_id AND user_id = $user_id;";
    
    // looping
    foreach($data as $d)
    {
        $answer_id = $answers && isset($answers[$d->id]) ? $answers[$d->id] : 0;
        $answer_id = htmlspecialchars( $answer_id );
        $score = "(CASE WHEN (SELECT COUNT(*) FROM exam_question_answers WHERE item_id = $d->id) > 0 THEN (SELECT score FROM exam_question_answers WHERE id = '$answer_id') ELSE NULL END)";
        $query .= "INSERT INTO exam_member_answers(user_id,schedule_id,question_item_id,answer_id,score)VALUES($user_id,$schedule_id,$d->id,'$answer_id',$score);";
    }
    
    $db->query = $query;
    $db->exec("multi_query");
    echo "User ID : $user_id AND Schedule ID : $schedule_id Success\n";
}
