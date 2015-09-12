<?php

class AccountstatusController extends AbstractRefController implements IController {
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
        $view = new ViewAccountstatus($params['left_bar_items'], $params['table_items'], $item_form);
        $view->getBody();
    }
//--------------- 
    protected function checkPost() {
        if (!empty($_POST['namestatus'])){
            return $obj = ['id' =>$_POST['id'],'namestatus'=>$_POST['namestatus']];
        } else {
            $_SESSION['msgs'][0] = 'Вы оставили поле пустым, заполните его';
            $_SESSION['msgs'][1] = ' red';
            return FALSE;
        }
    }
    
}
