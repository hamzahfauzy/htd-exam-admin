<?php
$auth = auth();

if(empty($auth))
{
    header('location:'.routeTo('auth/login'));
    die;
}

$authRoute = [
    'auth/login',
    'auth/logout',
];

if(!in_array($route, $authRoute) && $auth && !is_allowed($route, $auth->id))
{
    die('Error 403. Unauthorized');
}