<?php


class CurrencyController extends AbstractRefController implements IController {
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
        $view = new ViewCurrency($params['left_bar_items'], $params['table_items'], $item_form);
        $view->getBody();
    }
//--------------- 
    protected function checkPost() {
        if (!empty($_POST['name']) && !empty($_POST['shortname']) && !empty($_POST['code']) && !empty($_POST['codenumber'])){
            return $obj = ['id' =>$_POST['id'],'name'=>$_POST['name'],'shortname'=>$_POST['shortname'],'code'=>$_POST['code'],'codenumber'=>$_POST['codenumber']];
        } else {
            $_SESSION['msgs'][0] = 'Вы оставили поле пустым, заполните его';
            $_SESSION['msgs'][1] = ' red';
            return FALSE;
        }
    }
    
}
