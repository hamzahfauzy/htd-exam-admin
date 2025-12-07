<?php

namespace Core;

class Storage
{
    static function upload($file)
    {
        $parent_path = Utility::parentPath();
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $originialName = substr(pathinfo($file['name'], PATHINFO_FILENAME), 0, 20);
        $filename = strtotime('now').'-'.$originialName.'.'.$ext;
        $dest = $parent_path . 'storage/media/'.$filename;
        copy($file['tmp_name'], $dest);

        return 'storage/' . $filename;
    }

    static function exists($file)
    {
        $parent_path = Utility::parentPath();
        return file_exists($parent_path . 'storage/media/' . $file);
    }
}