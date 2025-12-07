<?php

foreach($_POST['group'] as $groupId)
{
    $db->insert('exam_schedule_groups', [
        'schedule_id' => $data->id,
        'group_id'    => $groupId
    ]);
}

if(!empty($_POST['question']))
{
    $db->insert('exam_schedule_questions',[
        'schedule_id' => $data->id,
        'question_id' => $_POST['question']
    ]);
}

// // generate user data
// $schedule = $data;
// $schedule_id = $data->id;
// if(!empty($_POST['question']))
// {
//     $schedule->question = $db->single('exam_questions', "id = (SELECT question_id FROM exam_schedule_questions WHERE schedule_id = $schedule_id)");
    
//     $db->query = "SELECT * FROM users WHERE id IN (SELECT user_id FROM exam_group_member WHERE group_id IN (SELECT group_id FROM exam_schedule_groups WHERE schedule_id = $schedule_id))";
//     $users = $db->exec('all');
//     foreach($users as $user)
//     {    
//         $db->query = "SELECT * FROM exam_question_items WHERE question_id = ".$schedule->question->id;
//         // random
//         if($schedule->randomize_question)
//         {
//             $db->query .= " ORDER BY RAND()";
//         }
    
//         // jumlah soal
//         if($schedule->question_showed)
//         {
//             $db->query .= " LIMIT $schedule->question_showed";
//         }
//         $items = $db->exec('all');
    
//         $randomize_answer = $schedule->randomize_answer;
//         $items = array_map(function($item) use ($db, $randomize_answer){
//             $db->query = "SELECT id, item_id, description FROM exam_question_answers WHERE item_id=$item->id";
//             if($randomize_answer)
//             {
//                 $db->query .= " ORDER BY RAND()";
//             }
    
//             $item->answers = $db->exec('all');
    
//             return $item;
//         }, $items);
    
//         $db->insert('exam_schedule_user_data', [
//             'schedule_id' => $schedule_id,
//             'user_id' => $user->id,
//             'data' => json_encode($items)
//         ]);
//     }
// }
