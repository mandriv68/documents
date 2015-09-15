<?php

class BankaccountsModel extends AbstractModel {
    
    protected static $table = 'bankaccounts';

    public static function factory($method,$input_params=NULL) {
        switch ($method) {
            case 'insert':
                $input_params[':company_edrpou'] = $input_params[':company'];
                $input_params[':accountstatus_id'] = $input_params[':status'];
                $input_params[':currency_id'] = $input_params[':currency'];
                $input_params[':banks_bic'] = $input_params[':bank'];
                return self::insert($input_params);
            
            case 'update':
                return self::update($input_params);
            
            case 'delete':
                return self::delete($input_params);
                
            case 'get':
                return self::get($input_params);

            default:
                $query = 'SELECT bankaccounts.`id`,'
                                .'bankaccounts.`numberaccount`,'
                                .'accountstatus.`namestatus` AS status_n,'
                                .'currency.`code` AS currency_n,'
                                .'CONCAT(banks.`ownership`, banks.`namebank`) AS bank_n,'
                                .'CONCAT(company.`ownership`, company.`namecompany`) AS company_n ' 
                                .'FROM bankaccounts, accountstatus, currency, banks, company ' 
                                .'WHERE accountstatus.`id` = bankaccounts.`status` ' 
                                .'AND currency.`id` = bankaccounts.`currency` '
                                .'AND banks.`bic` = bankaccounts.`bank` ' 
                                .'AND company.`edrpou` = bankaccounts.`company`';
                return self::all($query);
        }
    }
}
