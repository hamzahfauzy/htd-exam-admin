<?php

use Core\Storage;

$file = $_FILES['name'];
$name = $file['name'];


$data['name'] = Storage::upload($file);
$data['original_name'] = $name;
$data['created_by'] = auth()->id;