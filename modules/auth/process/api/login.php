<?php

use Core\Request;
use Core\Database;
use Core\JwtAuth;
use Core\Response;

if(Request::isMethod('post'))
{
    // login process here
    $db = new Database;
    $user = $db->single('users', [
        'username' => $_POST['username'],
        'password' => md5($_POST['password'])
    ]);

    if($user)
    {
        // jwt response
        return Response::json([
            'token' => (new JwtAuth)->generate([
                'user_id' => $user->id
            ])
        ], 'authentication success');
    }
    else
    {
        return Response::json([], __('auth.message.login_fail'), 404);
    }
}

return Response::json([], 'this method is not allowed');