<?php

class UsersModel extends AbstractModel {
        
    protected static $table = 'users';

    public static function factory($method,$input_params=NULL) {
        switch ($method) {
            case 'insert':
                return self::insert($input_params);
            
            case 'update':
                return self::update($input_params);
            
            case 'delete':
                return self::delete($input_params);
                
            case 'get':
                return self::get($input_params);

            default:
                $query = 'SELECT '. self::getFields()['fields'].' FROM '.self::$table;
                return self::all($query);
        }
    }
  
}
