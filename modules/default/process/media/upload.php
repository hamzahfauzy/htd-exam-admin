<?php

use Core\Storage;
use Core\Response;
use Core\Database;

$file = $_FILES['file'];
$name = $file['name'];

$data = [];
$data['name'] = Storage::upload($file);
$data['original_name'] = $name;
$data['created_by'] = auth()->id;

$db = new Database;
$db->insert('media', $data);

return Response::json([
    'location' => asset($data['name'])
],'success');