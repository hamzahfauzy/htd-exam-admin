<?php

use Core\Session;

Session::destroy();
header('location:'.routeTo('auth/login'));
die();