<?php

return '<a href="'.routeTo('crud/index',['table'=>'exam_question_answers','filter'=>['item_id' => $data->id]]).'" class="btn btn-sm btn-info"><i class="fas fa-eye"></i> '.__('exam.label.answers').'</a> ';