<?php

class BanksfilialModel extends AbstractModel {
        
    protected static $table = 'banksfilial';

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
                $query = 'SELECT banksfilial.`id`,'
                                .'banksfilial.`name`,'
                                .'CONCAT(ownership.`abbr`, banks.`namebank`) AS bank_n '
                                .'FROM banksfilial, ownership, banks ' 
                                .'WHERE banks.`bic` = banksfilial.`bic`';
                return self::all($query);
        }
    }
}
