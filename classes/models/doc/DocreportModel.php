<?php

class DocreportModel extends AbstractModel {
            
    protected static $table = 'docreport';

    public static function factory($method,$input_params=NULL) {
        switch ($method) {
            case 'insert':
                $input_params[':banks_bic'] = $input_params[':bank'];
                return self::insert($input_params);
            
            case 'update':
                return self::update($input_params);
            
            case 'delete':
                return self::delete($input_params);
                
            case 'get':
                return self::get($input_params);

            default:
                $query = 'SELECT * FROM docreport';
                return self::all($query);
        }
    }
}
