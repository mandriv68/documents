<?php

abstract class AbstractModel {
    
    protected static $class = '';
    protected static $table;

    protected static function getClass() {
        return static::$class = get_called_class();
    }
        
    protected static function getFields() {
        $fields = [];
        $query = 'SHOW COLUMNS FROM '.static::$table;
        $res = DB::getInstance()->fetchAll($query,self::getClass());
        foreach ($res as $value) {
            $fields['fields'] .= $value->Field.',';
            $fields['placeholders'] .= ':'.$value->Field.',';
        }
        $fields['fields'] = rtrim($fields['fields'], ',');
        $fields['placeholders'] = rtrim($fields['placeholders'], ',');
        return $fields;
    }

    protected static function insert($input_params) {
        array_shift($input_params);
        $fields = $placeholders = '';
        foreach ($input_params as $k => $v) {
            $placeholders .= $k.',';
            $fields .= ltrim($k, ':').',';
        }
        $query = 'INSERT INTO '.static::$table.' ('. rtrim($fields, ','). ') VALUES('. rtrim($placeholders, ','). ')';
        $res = DB::getInstance()->execute($query, $input_params);
        if ($res) {
            $_SESSION['msgs'][0] = 'запись успешно добавлена';
            $_SESSION['msgs'][1] = ' blue';
        } else {
            $_SESSION['msgs'][0] = 'неверный запрос';
            $_SESSION['msgs'][1] = ' red';
        }
        return $res;  //TRUE or FALSE
    }
    
    protected static function update($input_params) {
        $params = array_reverse($input_params);
        $where = ' WHERE ';
        $set = ' SET ';
        $cnt = count($params);
        foreach ($params as $key => $value) {
            --$cnt;
            if(!$cnt)
                {$where .= ltrim ($key, ':').'='.$key;}
            else
                {$set .= ltrim($key, ':').'='.$key.',';}

        }
        $query = 'UPDATE '.static::$table.  rtrim($set,',').$where;
        $res = DB::getInstance()->execute($query, $params);
        if ($res) {
            $_SESSION['msgs'][0] = 'запись успешно обновлена';
            $_SESSION['msgs'][1] = ' blue';
        } else {
            $_SESSION['msgs'][0] = 'неверный запрос';
            $_SESSION['msgs'][1] = ' red';
        }
        return $res;  //TRUE or FALSE
    }

    protected static function delete ($input_params) {
        $query = 'DELETE FROM '.static::$table.' WHERE id=:id';
        $res = DB::getInstance()->execute($query,$input_params);
        if ($res) {
            $_SESSION['msgs'][0] = 'запись успешно удалена';
            $_SESSION['msgs'][1] = ' blue';
            header("Location: /".static::$table."/main");
        } else {
            $_SESSION['msgs'][0] = 'неверный запрос';
            $_SESSION['msgs'][1] = ' red';
        }
        return $res;  //TRUE or FALSE
    }
    
    protected static function get($input_params) {
        $query = 'SELECT '. self::getFields()['fields'].' FROM '.static::$table.' WHERE id='.$input_params['id'].' LIMIT 1';
        $res = DB::getInstance()->fetchObj($query,self::getClass());
        if ($res) {
            $_SESSION['msgs'][0] = 'отредактируйте запись';
            $_SESSION['msgs'][1] = ' green';
        } else {
            $_SESSION['msgs'][0] = 'неверный запрос,запись отсутствует';
            $_SESSION['msgs'][1] = ' red';
        }
        return $res;  //OBJECT or FALSE
    }
    
    protected static function all($query) {
        $res = DB::getInstance()->fetchAll($query,self::getClass());
        if (!$res) {$_SESSION['result'] = 'в справочнике пусто, выросла капуста';}
        return $res;  //ARRAY or FALSE
    }
    
    protected static function getAll($query) {
        return DB::getInstance()->fetchAll($query,self::getClass());
    }
    
    protected static function getOne($query) {
        return DB::getInstance()->fetchObj($query,  self::getClass());
    }
    
    protected static function saveANDdelete($query,$input_params) {
        return DB::getInstance()->execute($query,$input_params);
    }
    
}
