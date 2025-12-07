<?php

return '<a href="'.routeTo('crud/index',['table'=>'exam_question_items','filter'=>['question_id' => $data->id]]).'" class="btn btn-sm btn-info"><i class="fas fa-eye"></i> '.__('exam.label.question_items').'</a> 
<a href="'.routeTo('exam/questions/preview',['id' => $data->id]).'" class="btn btn-sm btn-info"><i class="fas fa-eye"></i> '.__('exam.label.preview').'</a> ';