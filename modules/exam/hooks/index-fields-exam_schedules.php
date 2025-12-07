<?php

use Core\Request;

$role = get_role(auth()->id);

$fields['schedule_status'] = [
    'label' => __('exam.label.schedule_status'),
    'type'  => 'text',
    'search' => false
];

if($role->role_id == env('EXAM_MEMBER_ROLE_ID'))
{
    $fields['exam_user_status'] = [
        'label' => __('exam.label.exam_user_status'),
        'type'  => 'text',
        'search' => false
    ];
    unset($fields['status']);
    unset($fields['question_showed']);
    unset($fields['randomize_question']);
    unset($fields['randomize_answer']);
}
else
{
    $fields['randomize_question']['type'] = 'text';
    $fields['randomize_answer']['type'] = 'text';
}

$fields['token'] = [
    'label' => 'Token',
    'type'  => 'text'
];

if(Request::$isApiRoute)
{
    $fields = array_merge([
        'id' => [
            'label' => 'id',
            'type'  => 'text'
        ]
    ], $fields);
}

return $fields;