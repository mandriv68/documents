<?php

class OwnershipModel extends AbstractModel {
    
    protected static $table = 'ownership';

    public static function factory($method,$input_params=NULL) {
        switch ($method) {
            case 'insert':
                array_shift($input_params);
                $params = self::insert($input_params);
                $query = 'INSERT INTO '.self::$table.' ('.$params['fields'].') VALUES('.$params['placeholders'].')';
                $res = self::saveANDdelete($query, $input_params);
                if ($res) {
                    $_SESSION['msgs'][0] = 'запись успешно добавлена';
                    $_SESSION['msgs'][1] = ' blue';
                } else {
                    $_SESSION['msgs'][0] = 'неверный запрос';
                    $_SESSION['msgs'][1] = ' red';
                }
                break;
            
            case 'update':
                $input_params = array_reverse($input_params);
                $params = self::update($input_params);
                $query = 'UPDATE '.self::$table.$params['set'].$params['where'];
                $res = self::saveANDdelete($query, $input_params);
                if ($res) {
                    $_SESSION['msgs'][0] = 'запись успешно обновлена';
                    $_SESSION['msgs'][1] = ' blue';
                } else {
                    $_SESSION['msgs'][0] = 'неверный запрос';
                    $_SESSION['msgs'][1] = ' red';
                }
                break;
            
            case 'delete':
                $query = 'DELETE FROM '.self::$table.' WHERE id=:id';
                $res = self::saveANDdelete($query, $input_params);
                if ($res) {
                    $_SESSION['msgs'][0] = 'запись успешно удалена';
                    $_SESSION['msgs'][1] = ' blue';
                    header("Location: /".self::$table."/main");
                } else {
                    $_SESSION['msgs'][0] = 'неверный запрос';
                    $_SESSION['msgs'][1] = ' red';
                }
                break;
                
            case 'get':
                $query = 'SELECT '. self::getFields()['fields'].' FROM '.self::$table.' WHERE id='.$input_params['id'].' LIMIT 1';
                $res = self::getOne($query);
                if ($res) {
                    $_SESSION['msgs'][0] = 'отредактируйте запись';
                    $_SESSION['msgs'][1] = ' green';
                } else {
                    $_SESSION['msgs'][0] = 'неверный запрос,запись отсутствует';
                    $_SESSION['msgs'][1] = ' red';
                }
                return $res;

            default:
                $query = 'SELECT '. self::getFields()['fields'].' FROM '.self::$table;
                $res = self::getAll($query);
                if (!$res) $_SESSION['result'] = 'в справочнике пусто, выросла капуста';
                return $res;
        }
    }
    
}
