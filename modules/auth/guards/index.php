<?php
use Core\Database;
use Core\Session;

$auth = auth();
$publicRoutes = \Core\Request::getPublicRoutes();

if(empty($auth) && isset($_COOKIE['remember_token']))
{
    $db = new Database;
    $user = $db->single('users', [
        'remember_token' => $_COOKIE['remember_token']
    ]);

    if($user)
    {
        Session::set(['user_id'=>$user->id]);
    
        $auth = auth();
    }

}

if(empty($auth) && !in_array($route, $publicRoutes))
{
    header("location: ".routeTo('auth/login'));
    die();
}

if($auth && $route == 'auth/login')
{
    $AUTH_AFTER_LOGIN_SUCCESS = env('APP_PATH', '') .'/'. env('AUTH_AFTER_LOGIN_SUCCESS','');
    header("location: ". $AUTH_AFTER_LOGIN_SUCCESS);
    die();
}