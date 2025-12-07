<?php

return [
    [
        'label' => 'default.menu.media',
        'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-photo-film',
        'route' => routeTo('crud/index',['table' => 'media']),
        'activeState' => 'default.media'
    ],
    [
        'label' => 'default.menu.calendar',
        'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-calendar',
        'route' => routeTo('crud/index',['table' => 'calendar']),
        'activeState' => 'default.calendar'
    ],
    [
        'label' => 'default.menu.users',
        'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-users',
        'route' => routeTo('crud/index',['table'=>'users']),
        'activeState' => 'default.users'
    ],
    [
        'label' => 'default.menu.roles',
        'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-cubes',
        'route' => routeTo('crud/index',['table'=>'roles']),
        'activeState' => 'default.roles'
    ],
    [
        'label' => 'default.menu.settings',
        'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-cog',
        'route' => routeTo('default/settings/index'),
        'activeState' => 'default.settings'
    ],
];