<?php

use Core\Page;
use Core\Request;
use Core\Database;
use Core\Response;

$schedule_id = $_GET['id'];
$db = new Database;
$schedule = $db->single('exam_schedules',[
    'id' => $schedule_id,
]);

if($schedule)
{
    $schedule_user_data = $db->single('exam_schedule_user_data', [
        'schedule_id' => $schedule_id,
        'user_id'     => auth()->id
    ]);
        
    if($schedule_user_data)
    {
        $title = "Ringkasan - ".$schedule->name;
        Page::setTitle($title);
    
        $schedule_user_data->data = json_decode($schedule_user_data->data);

        $answers = $db->all('exam_member_answers', [
            'schedule_id' => $schedule_id,
            'user_id' => auth()->id
        ]);

        $normalizeAnswers = [];
        $totalScore = 0;
        foreach($answers as $answer)
        {
            $normalizeAnswers[$answer->question_item_id] = $answer;
            $totalScore += $answer->score;
        }
    
        return view('exam/views/result', compact('schedule_user_data','normalizeAnswers','totalScore'));
    }
}


set_flash_msg(['error'=>"Maaf! Data tidak valid"]);

header('location:'.routeTo('crud/index',[
    'table' => 'exam_schedules'
]));
die();
