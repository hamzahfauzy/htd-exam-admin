<?php

unset($fields['password']);

$fields['new_password'] = [
    'label' => __('default.label.users_password'),
    'type'  => 'password',
];

return $fields;