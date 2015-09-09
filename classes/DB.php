<?php

class DB {
    
    public static $_instance;
    private $_dbh;
    
    public static function getInstance() {
        if (!self::$_instance instanceof self)
            self::$_instance = new self;
        return self::$_instance;
    }
    
    public function __construct() {
        $config = Config::getDbConfig();
        $dsn = "mysql:host=".$config['host'].";dbname=".$config['dbname'];
        $options = [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,];
        $this->_dbh = new PDO($dsn, $config['login'], $config['password'], $options);
    }
    
    public function query($query) {
        $stmt = $this->_dbh->query($query);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$res) {
            throw new MyException('Ошибка: (код:'.$stmt->errorInfo()[1].') '.$stmt->errorInfo()[2]);
        } else {
            return $res;
        }
    }
    
    public function fetchAll($query, $class='stdclass') {
        $stmt = $this->_dbh->query($query);
        return $stmt->fetchAll(PDO::FETCH_CLASS,$class);
//        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
//        if (!$res) {
//            throw new MyException('Ошибка: (код:'.$stmt->errorInfo()[1].') '.$stmt->errorInfo()[2]);
//        } else {
//            return $res;
//        }
    }
    
    public function fetchObj($query, $class = 'stdclass') {
        $stmt = $this->_dbh->query($query);
        $res = $stmt->fetchObject($class);
        if (!$res) {
            throw new MyException('Ошибка: (код:'.$stmt->errorInfo()[1].') '.$stmt->errorInfo()[2]);
        } else {
            return $res;
        }
    }
    
    public function execute($query,$input_params) {
        $stmt = $this->_dbh->prepare($query);
        $res = $stmt->execute($input_params);
        if (!$res) {
            throw new MyException('Ошибка: (код:'.$stmt->errorInfo()[1].') '.$stmt->errorInfo()[2]);
        } else {
            return $res;
        }
    }
}
