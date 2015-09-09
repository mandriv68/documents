<?php

class ReferenceModel extends AbstractModel {
    
    private $where = '';
    
    public static function refFactory($method,$input_params=NULL) {
        switch ($method) {
            case 'insert':
                $fld = $plchld = '';
                array_shift($input_params);
                foreach ($input_params as $k => $v) {
                    $plchld .= $k.',';
                    $fld .= ltrim($k, ':').',';
                }
                $fields = rtrim($fld, ',');
                $placeholders = rtrim($plchld, ',');
                $query = 'INSERT INTO '.self::$table.' ('.$fields.') VALUES('.$placeholders.')';
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
                $params = array_reverse($input_params);
                $where = ' WHERE ';
                $set = ' SET ';
                $cnt = count($params);
                foreach ($params as $key => $value) {
                    --$cnt;
                    if(!$cnt)
                        $where .= ltrim ($key, ':').'='.$key;
                    else
                        $set .= ltrim($key, ':').'='.$key.',';
                  
                }
                $query = 'UPDATE '.self::$table.  rtrim($set, ',').$where;
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
                $query = 'SELECT '. self::getFields().' FROM '.self::$table.' WHERE id='.$input_params['id'].' LIMIT 1';
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
                $query = 'SELECT '. self::getFields().' FROM '.self::$table;
                $res = self::getAll($query);
                if (!$res) $_SESSION['result'] = 'в справочнике пусто, выросла капуста';
                return $res;
        }
    }
    
    
    
}
