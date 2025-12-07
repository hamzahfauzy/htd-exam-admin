<?php

use Core\Page;

Page::set_title(__("crud.label.home"));
Page::setActive("crud.label.home");

return view('default/views/index');