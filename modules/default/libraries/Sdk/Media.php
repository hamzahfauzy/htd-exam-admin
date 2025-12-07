<?php

namespace Modules\Default\Libraries\Sdk;

use Core\Database;
use Core\Storage;

class Media
{
    static $db = null;
    static $tableName = 'media';

    static function init()
    {
        self::$db = new Database();
    }
    
    static function singleUpload($file, $record_type = '')
    {
        self::init();

        $name = $file['name'];
        $ext = pathinfo($name, PATHINFO_EXTENSION);
        $data = [];

        $data['name'] = Storage::upload($file);
        $data['original_name'] = substr(pathinfo($name, PATHINFO_FILENAME), 0, 20).'.'.$ext;
        $data['record_type'] = $record_type;

        if(auth())
        {
            $data['created_by'] = auth()->id;
        }

        return self::$db->insert(self::$tableName, $data);
    }

    static function findById($id)
    {
        self::init();

        return self::$db->single(self::$tableName, [
            'id' => $id
        ]);
    }

    static function findByOwner($user_id)
    {
        self::init();

        return self::$db->all(self::$tableName, [
            'created_by' => $user_id
        ]);
    }
}