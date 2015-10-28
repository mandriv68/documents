<?php

class CompanyModel extends AbstractModel {
    
    protected static $table = 'company';

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
                
            case 'find_the_edrpou':
                return self::findTheEdrpou($input_params);

            default:
                $query = 'SELECT company.id,'
                               .'company.edrpou,'
                               .'ownership.abbr AS ownershipabbr,'
                               .'company.namecompany,'
                               .'company.flag,'
                               .'company.regoffice,'
                               .'company.itn '
                        .'FROM company, ownership '
                        .'WHERE ownership.id=company.ownership '
                        .'ORDER BY company.id';
                return self::all($query);
        }
    }
    
    protected static function findTheEdrpou($input_params) {
        $query = 'SELECT ownership.abbr AS ownershipabbr, company.namecompany FROM ownership, company WHERE ownership.id = company.ownership AND company.edrpou = '.$input_params.' LIMIT 1';
        $res = DB::getInstance()->fetchObj($query,self::getClass());
        return $res;  //OBJECT or FALSE
    }
    
}
