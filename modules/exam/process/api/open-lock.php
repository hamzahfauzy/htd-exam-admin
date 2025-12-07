<?php
use Core\Request;
use Core\Database;
use Core\Response;
use Core\Setting;

$status = false;
if(Request::isMethod('POST'))
{
    $status = $_POST['token'] == Setting::get('lock_token');
}

return Response::json([
    'status' => $status
], 'timer retrieved');