<?php

namespace Modules\Default\Libraries\Repositories;

use Core\Database;

class UserRepository
{
    private $db;
    function __construct()
    {
        $this->db = new Database;
    }

    function get()
    {
        return $this->db->all('users');
    }
}