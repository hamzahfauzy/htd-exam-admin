<?php

use Core\Database;
use Core\Response;

$auth = auth();

if(empty($auth))
{
    header('location:'.routeTo('auth/login'));
    die;
}

if(in_array($route,['crud/edit','crud/delete']) && $_GET['table'] == 'exam_questions')
{
    $db = new Database();
    $question = $db->single('exam_questions', [
        'id' => $_GET['id']
    ]);

    $isSuperAdmin = false;
    $allowedRoutes = get_allowed_routes($auth->id);
    foreach($allowedRoutes as $path)
    {
        if($path->route_path == '*')
        {
            $isSuperAdmin = true;
            break;
        }
    }
    if($question->created_by != $auth->id && !$isSuperAdmin)
    {
        set_flash_msg(['error'=>__("exam.label.unauthorized")]);
        header("location: ".$_SERVER['HTTP_REFERER']);
        die();
    }
}

if($route == 'exam/refresh-session')
{
    echo Response::json([], 'session refreshed');
    die();
    return true;
}

if($route == 'exam/test')
{
    $db = new Database;
    $data = $db->single('exam_schedule_user_data');

    $data->data = json_decode($data->data);

    echo Response::json($data, '');
    die();
    return true;
}

return true;