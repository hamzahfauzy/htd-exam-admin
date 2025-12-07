<?php

return '<a href="'.routeTo('crud/index',['table'=>'user_roles','filter'=>['user_id' => $data->id]]).'" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i> '.__('crud.label.view').'</a> ';