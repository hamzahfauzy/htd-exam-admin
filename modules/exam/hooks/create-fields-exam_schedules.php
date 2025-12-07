<?php

$fields = array_merge($fields, [
    'group' => [
        'label' => __('exam.label.group'),
        'type'  => 'options-obj:exam_groups,id,name',
        'attr'  => [
            'multiple' => 'true'
        ]
    ],
    'question' => [
        'label' => __('exam.label.question'),
        'type'  => 'options-obj:exam_questions,id,name'
    ]
]);

return $fields;