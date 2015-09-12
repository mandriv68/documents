<?php

abstract class AbstractModel {
    
    protected static $class = '';
    protected static $table;

    protected static function getClass() {
        return static::$class = get_called_class();
    }
    
        protected static function getFields() {
        $fields = [];
        $query = 'SHOW COLUMNS FROM '.static::$table;
        $res = DB::getInstance()->fetchAll($query,self::getClass());
        foreach ($res as $value) {
            $fields['fields'] .= $value->Field.',';
            $fields['placeholders'] .= ':'.$value->Field.',';
        }
        $fields['fields'] = rtrim($fields['fields'], ',');
        $fields['placeholders'] = rtrim($fields['placeholders'], ',');
        return $fields;
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
