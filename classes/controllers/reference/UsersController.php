<?php

class UsersController extends AbstractRefController implements IController {
            
    protected $_fc;
    protected $model;
//---------------
    public function __construct() {
        $this->_fc = FrontController::getInstance();
        $this->model =(rtrim(get_class($this), 'Controller')).'Model';
    }
//---------------   
    public function mainAction($item_form = NULL) {
        parent::mainAction($item_form);
    }
//---------------    
    public function getAction() {
        parent::getAction($this->model);
    }
//---------------    
    public function deleteAction() {
        parent::deleteAction($this->model);
    }
//---------------    
    protected function save($fabric_method, $param) {
        parent::save($fabric_method, $param, $this->model);
    }
//---------------    
    protected function viewMain($item_form) {
        $params = parent::viewMain($this->model);
        $view = new ViewUsers($params['left_bar_items'], $params['table_items'], $item_form);
        $view->getBody();
    }
//---------------    
    protected function checkPost() {
        if (!empty($_POST['login']) && !empty($_POST['privileg']) && !empty($_POST['count_it']) && !empty($_POST['salt']) && !empty($_POST['pass'])) {
            return $obj = [ 'id' =>$_POST['id'],
                            'login' =>$_POST['login'],
                            'count_it' =>$_POST['count_it'],
                            'salt' =>$_POST['salt'],
                            'pass'=>$_POST['pass']];
        } else {
            $_SESSION['msgs'][0] = 'Вы оставили поле пустым, заполните его';
            $_SESSION['msgs'][1] = ' red';
            return FALSE;
        }
    }
    
}
