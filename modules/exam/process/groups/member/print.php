<?php

use Core\Database;
use Core\Response;

$params   = "";
if(isset($_GET['group_id']))
{
    $params = " WHERE exam_group_member.group_id = $_GET[group_id]";
}

$db = new Database;

$db->query  = "SELECT 
                 users.id user_id,
                 users.name, 
                 username,
                 exam_groups.id group_id,
                 exam_groups.name group_name,
                 exam_group_member.exam_room exam_room
                FROM 
                 users
                JOIN
                 exam_group_member ON user_id = users.id
                JOIN
                 exam_groups ON exam_groups.id = exam_group_member.group_id
                $params
                ";
$member     = $db->exec('all');
$passwords  = [];
foreach($member as $m)
{
    $pass = mt_rand(1111111111, 9999999999);
    $passwords[$m->user_id] = $pass;
    
    $pass = md5($pass);

    $db->update('users', [
        'password' => $pass
    ], [
        'id' => $m->user_id
    ]);
}

return view('exam/views/groups/member/print', compact('member', 'passwords'));