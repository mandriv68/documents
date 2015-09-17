<?php

class EmploeesModel extends AbstractModel {
    
    protected static $table = 'emploees';

    public static function factory($method,$input_params=NULL) {
        switch ($method) {
            case 'insert':
                $input_params[':company_edrpou'] = $input_params[':company'];
                $input_params[':posts_id'] = $input_params[':post'];
                return self::insert($input_params);
            
            case 'update':
                return self::update($input_params);
            
            case 'delete':
                return self::delete($input_params);
                
            case 'get':
                return self::get($input_params);

            default:
                $query = 'SELECT emploees.`id`,'
                                .'CONCAT(emploees.`firstname`," ",emploees.`lastname`) AS fullname,'
                                .'CONCAT(ownership.`abbr`," ",company.`namecompany`,'
                                        .'"::",posts.`postname`) AS company_and_post ' 
                                .'FROM emploees, company, posts, ownership '
                                .'WHERE company.`edrpou` = emploees.`company` '
                                .'AND posts.`id` = emploees.`post` '
                                .'AND ownership.`id` = company.`ownership`';
                return self::all($query);
        }
    }
    
}
