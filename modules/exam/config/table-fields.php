<?php

return [
    'exam_groups'  => [
        'name' => [
            'label' => __('exam.label.name'),
            'type'  => 'text'
        ],
    ],
    'exam_group_member'  => [
        'group_id' => [
            'label' => __('exam.label.group'),
            'type'  => 'options-obj:exam_groups,id,name'
        ],
        'user_id' => [
            'label' => __('exam.label.user'),
            'type'  => 'options-obj:users,id,name'
        ],
        'exam_room' => [
            'label' => __('exam.label.exam_room'),
            'type'  => 'text'
        ]
    ],
    'exam_questions'  => [
        'name' => [
            'label' => __('exam.label.name'),
            'type'  => 'text'
        ],
        'created_by' => [
            'label' => __('exam.label.created_by'),
            'type'  => 'options-obj:users,id,name'
        ],
    ],
    'exam_question_items'  => [
        'question_id' => [
            'label' => __('exam.label.exam_question'),
            'type'  => 'options-obj:exam_questions,id,name'
        ],
        'description' => [
            'label' => __('exam.label.description'),
            'type'  => 'textarea',
            'attr'  => [
                'class' => 'ckeditor form-control'
            ]
        ],
    ],
    'exam_question_answers'  => [
        'item_id' => [
            'label' => __('exam.label.question'),
            'type'  => 'options-obj:exam_question_items,id,description'
        ],
        'description' => [
            'label' => __('exam.label.description'),
            'type'  => 'textarea',
            'attr' => [
                'class' => 'ckeditor form-control'
            ]
        ],
        'score' => [
            'label' => __('exam.label.score'),
            'type'  => 'number'
        ],
    ],
    'exam_schedules'  => [
        'name' => [
            'label' => __('exam.label.name'),
            'type'  => 'text'
        ],
        'start_at' => [
            'label' => __('exam.label.start_at'),
            'type'  => 'datetime-local'
        ],
        'end_at' => [
            'label' => __('exam.label.end_at'),
            'type'  => 'datetime-local'
        ],
        'status' => [
            'label' => __('exam.label.status'),
            'type'  => 'options:PUBLISH|DRAFT'
        ],
        'question_showed' => [
            'label' => __('exam.label.question_showed'),
            'type'  => 'number'
        ],
        'randomize_question' => [
            'label' => __('exam.label.randomize_question'),
            'type'  => 'options:{"Ya":1,"Tidak":0}'
        ],
        'randomize_answer' => [
            'label' => __('exam.label.randomize_answer'),
            'type'  => 'options:{"Ya":1,"Tidak":0}'
        ],
    ],
    'exam_schedule_groups'  => [
        'schedule_id' => [
            'label' => __('exam.label.schedule'),
            'type'  => 'options-obj:exam_schedules,id,name'
        ],
        'group_id' => [
            'label' => __('exam.label.group'),
            'type'  => 'options-obj:exam_groups,id,name'
        ],
    ],
    'exam_schedule_questions'  => [
        'schedule_id' => [
            'label' => __('exam.label.schedule'),
            'type'  => 'options-obj:exam_schedules,id,name'
        ],
        'question_id' => [
            'label' => __('exam.label.exam_question'),
            'type'  => 'options-obj:exam_questions,id,name'
        ],
    ],
];