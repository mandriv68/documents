<?php

/**
 * Description of FrontController
 *
 * @author admin
 */

class FrontController 
{
    private $_controller = '';
    private $_action = '';
    private $_params = [];
    private  static $instance;
    
    /* объявляем синглтон */
    public static function getInstance()
    {
        if (!(self::$instance instanceof self))
            self::$instance = new self;
        return self::$instance;
    }
    
    public function __construct() {
        $request = $_SERVER['REQUEST_URI'];
        $splits = explode('/', ltrim($request, '/'));
        $this->_controller = $splits[0] ? ucfirst($splits[0]).'Controller' : 'IndexController';
        $this->_action = $splits[1] ? strtolower($splits[1]).'Action' : 'mainAction';
        if (!empty($splits[2])) {
            $key = $value = [];
            for ($i=2,$cnt=count($splits); $i<$cnt; $i++) {
                /* если чётный ключ Splits -> массив названий параметров */
                if ($i % 2 == 0) $key[] = $splits[$i];
                /* если нечётный ключ Splits -> массив значений параметров */
                else $value[] = $splits[$i];
            }
            $this->_params = array_combine($key, $value);
        }
    }
    
    private function getController() {
        return $this->_controller;
    }
    
    private function getAction() {
        return $this->_action;
    }
    
    public function getParams() {
        return $this->_params;
    }
    
    public function route() {
        if (class_exists($this->getController())) {
            $rc = new ReflectionClass($this->getController());
            if ($rc->implementsInterface('IController')) {
                if ($rc->hasMethod($this->getAction())) {
                    /* создаём объект класса Controller*/
                    $controller = $rc->newInstance();
                    $method = $rc->getMethod($this->getAction());
                    /* запускаем Action на выполнение */
                    $method->isStatic() ? $method->invoke(NULL) : $method->invoke($controller);
                } else {
                    throw new MyException('В контроллере '. $this->getController().'  отсутствует вызываемый метод '.$this->getAction());
                }
            } else {
                throw new MyException ('У контроллера '. $this->getController().' отсутствует интерфейс IController');
            }
        } else {
            throw new MyException($this->getController().' не является классом');
        }
    }
    
}
