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

    protected static function insert($params) {
        $fld = $plchld = '';
        foreach ($params as $k => $v) {
            $plchld .= $k.',';
            $fld .= ltrim($k, ':').',';
        }
        return ['fields'=>rtrim($fld, ',') , 'placeholders'=>rtrim($plchld, ',')];
    }
    
    protected static function update($params) {
        $where = ' WHERE ';
        $set = ' SET ';
        $cnt = count($params);
        foreach ($params as $key => $value) {
            --$cnt;
            if(!$cnt)
                {$where .= ltrim ($key, ':').'='.$key;}
            else
                {$set .= ltrim($key, ':').'='.$key.',';}

        }
//        Dump::vardump($set,$where);die;
        return ['set'=>rtrim($set, ',') , 'where'=>$where];
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
