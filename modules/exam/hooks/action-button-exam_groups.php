<?php

return '<a href="'.routeTo('crud/index',['table'=>'exam_group_member','filter'=>['group_id' => $data->id]]).'" class="btn btn-sm btn-info"><i class="fas fa-eye"></i> '.__('exam.label.member').'</a> ';