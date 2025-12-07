<?php

namespace Core;

class TableField 
{
    private $tableName;
    private $fields;
    private $module;
    
    function __construct($tableName, $fields, $module)
    {
        $this->tableName = $tableName;
        $this->fields = $fields;
        $this->module = $module;
    }

    function getFields()
    {
        $fields = $this->fields;
        $currentRoute  = Request::getRoute();

        // for crud
        $actionHooks = 'index';
        if(startWith($currentRoute, 'crud/'))
        {
            $actionHooks = str_replace('crud/','', $currentRoute);
        }
        $hookFile = Utility::parentPath() . "modules/$this->module/hooks/$actionHooks-fields-$this->tableName.php";
        if(file_exists($hookFile))
        {
            return require $hookFile;
        }

        return $fields;
    }

    function getModule()
    {
        return $this->module;
    }

    function getTableName()
    {
        return $this->tableName;
    }
}