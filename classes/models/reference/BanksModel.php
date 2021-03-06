<?php

class BanksModel extends AbstractModel {
    
    protected static $table = 'banks';


    public static function factory($method,$input_params=NULL) {
        switch ($method) {
            case 'insert':
                $input_params[':ownership_id'] = $input_params[':ownership'];
                return self::insert($input_params);
            
            case 'update':
                return self::update($input_params);
            
            case 'delete':
                return self::delete($input_params);
                
            case 'get':
                return self::get($input_params);

            default:
                $query = 'SELECT banks.id, banks.bic, ownership.abbr AS ownershipabbr, banks.namebank, banks.adress FROM banks, ownership WHERE ownership.id=banks.ownership';
                return self::all($query);
        }
    }
}
