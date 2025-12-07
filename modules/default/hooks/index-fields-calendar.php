<?php

unset($fields['description']);

if(get_role(auth()->id)->role_id == 1)
{
    $fields['created_by'] = [
        'label' => __('default.label.user'),
        'type'  => 'options-obj:users,id,name'
    ];
}


return $fields;