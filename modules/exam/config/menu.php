<?php

return [
    [
        'label' => 'exam.menu.groups',
        'route' => routeTo('crud/index',['table'=>'exam_groups']),
        'icon' => 'fa-fw fa-xl me-2 fa-solid fa-layer-group',
        'activeState' => [
            'exam.exam_groups',
            'exam.exam_group_member',
        ]
    ],
    [
        'label' => 'exam.menu.questions',
        'route' => routeTo('crud/index',['table'=>'exam_questions']),
        'icon' => 'fa-fw fa-xl me-2 fa-solid fa-file-circle-question',
        'activeState' => 'exam.exam_questions'
    ],
    [
        'label' => 'exam.menu.schedules',
        'route' => routeTo('crud/index',['table'=>'exam_schedules']),
        'icon' => 'fa-fw fa-xl me-2 fa-solid fa-calendar-days',
        'activeState' => 'exam.exam_schedules'
    ],
    // [
    //     'label' => 'exam.menu.exams',
    //     'icon'  => 'fa-fw fa-xl me-2 fa-solid fa-graduation-cap',
    //     'activeState' => [
    //         'exam.exam_groups',
    //         'exam.exam_group_member',
    //         'exam.exam_questions',
    //         'exam.exam_schedules',
    //     ],
    //     'items' => [
            
    //     ]
    // ],
];