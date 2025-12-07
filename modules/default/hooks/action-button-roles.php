<?php

return '<a href="'.routeTo('crud/index',['table'=>'role_routes','filter[role_id]'=>$data->id]).'" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i> '.__('crud.label.view').'</a> ';