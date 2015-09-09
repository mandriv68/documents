<?php

abstract class AbstractModel {
    
    protected static $class = '';
    protected static $table;
    protected static $fields = '';
    protected static $placeholders = '';
    
    public static function setParams($table) {
        static::$table = $table;
    }

    protected static function getClass() {
        return static::$class = get_called_class();
    }
    
    protected static function getFields() {
//        $query = 'SHOW COLUMNS FROM '.static::$table;
//        $res = DB::getInstance()->fetchAll($query,self::getClass());
//        foreach ($res as $value) {
//            self::$fields .= $value->Field.',';
//        }
//        return rtrim(self::$fields,',');
        return 'id,postname';
    }
    
    protected static function getPlaceholders() {
        $arr = explode(',', self::getFields());
        foreach ($arr as $value) {
            self::$placeholders .= ':'.$value.','; 
        }
        return rtrim(self::$placeholders,',');
    }

    protected static function getAll($query) {
        return DB::getInstance()->fetchAll($query,self::getClass());
    }
    
    protected static function getOne($query) {
        return DB::getInstance()->fetchObj($query,  self::getClass());
    }
    
    protected static function saveANDdelete($query,$input_params) {
        return DB::getInstance()->execute($query,$input_params);
    }
}
