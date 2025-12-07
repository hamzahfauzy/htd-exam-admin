<?php

namespace Core;

class Setting
{
    private static $data = [];
    public static function setData($data)
    {
        self::$data = $data;
    }

    public static function dataExists()
    {
        return count(self::$data);
    }

    public static function get($key = false)
    {
        if(!self::dataExists())
        {
            // get data from database
            $db = new Database;
            $settings = $db->all('settings');
            $tmpData = [];
            foreach($settings as $setting)
            {
                $tmpData[$setting->setting_key] = $setting->setting_value;
            }

            self::setData($tmpData);
        }

        if(!$key && self::dataExists())
        {
            return self::$data;
        }

        return isset(self::$data[$key]) ? self::$data[$key] : false;
    }

    public static function save($key, $value)
    {
        $db = new Database;
        if($db->exists('settings', ['setting_key' => $key]))
        {
            $db->update('settings',[
                'setting_value' => $value
            ], [
                'setting_key' => $key
            ]);
        }
        else
        {
            $db->insert('settings', [
                'setting_key' => $key,
                'setting_value' => $value
            ]);
        }
    }
}