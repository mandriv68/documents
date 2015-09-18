<?php

class PersonalaccountsModel extends AbstractModel {
        
    protected static $table = 'personalaccounts';

    public static function factory($method,$input_params=NULL) {
        switch ($method) {
            case 'insert':
                $input_params[':company_edrpou'] = $input_params[':company'];
                return self::insert($input_params);
            
            case 'update':
                return self::update($input_params);
            
            case 'delete':
                return self::delete($input_params);
                
            case 'get':
                return self::get($input_params);

            default:
                $query = 'SELECT personalaccounts.`id`,'
                               .'personalaccounts.`numberaccount`,'
                               .'personalaccounts.`contract`,'
                               .'personalaccounts.`meter`,'
                               .'CONCAT(ownership.`abbr`," ",company.`namecompany`) AS company_n,'
                               .'personalaccounts.`accountpurpose` '
                        .'FROM personalaccounts, company, ownership '
                        .'WHERE company.`edrpou` = personalaccounts.`company` '
                        .'AND ownership.`id` = company.`ownership`';
                return self::all($query);
        }
    }
}
