<?php

if(isset($data['new_password']) && !empty($data['new_password']))
{
    $data['password'] = md5($data['new_password']);
}

unset($data['new_password']);