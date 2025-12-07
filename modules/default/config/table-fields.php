<?php

return [
    'users'  => [
        'name' => [
            'label' => __('default.label.users_name'),
            'type'  => 'text'
        ],
        'username' => [
            'label' => __('default.label.users_username'),
            'type'  => 'text'
        ],
        'password' => [
            'label' => __('default.label.users_password'),
            'type'  => 'password',
        ],
    ],
    'roles'  => [
        'name' => [
            'label' => __('default.label.roles_name'),
            'type'  => 'text'
        ],
    ],
    'role_routes'  => [
        'role_id' => [
            'label' => __('default.label.role_routes_role'),
            'type'  => 'options-obj:roles,id,name'
        ],
        'route_path' => [
            'label' => __('default.label.role_routes_path'),
            'type'  => 'text'
        ],
    ],
    'user_roles'  => [
        'user_id' => [
            'label' => __('default.label.user_roles_user'),
            'type'  => 'options-obj:users,id,name'
        ],
        'role_id' => [
            'label' => __('default.label.user_roles_role'),
            'type'  => 'options-obj:roles,id,name'
        ],
    ],
    'media' => [
        'original_name' => [
            'label' => __('default.label.file_name'),
            'type' => 'text'
        ],
        'name' => [
            'label' => __('default.label.file'),
            'type' => 'file'
        ],
        'created_by' => [
            'label' => __('default.label.created_by'),
            'type' => 'options-obj:users,id,name'
        ],
        'created_at' => [
            'label' => __('default.label.created_at'),
            'type' => 'datetime-local'
        ],
        'record_type' => [
            'label' => __('default.label.record_type'),
            'type' => 'text'
        ],
    ],
    'calendar' => [
        'title' => [
            'label' => __('default.label.title'),
            'type'  => 'text'
        ],
        'description' => [
            'label' => __('default.label.description'),
            'type'  => 'textarea'
        ],
        'start_at' => [
            'label' => __('default.label.start_at'),
            'type'  => 'datetime-local'
        ],
        'end_at' => [
            'label' => __('default.label.end_at'),
            'type'  => 'datetime-local'
        ],
        'record_type' => [
            'label' => __('default.label.record_type'),
            'type'  => 'text'
        ],
        'visibility' => [
            'label' => __('default.label.visibility'),
            'type'  => 'options:PRIVATE|PUBLIC'
        ],
    ]
];