<?php

class PostsController extends AbstractRefController implements IController {
    
    protected $_fc;
    protected $_table;


    public function __construct() {
        $this->_fc = FrontController::getInstance();
        $this->_table = strtolower(rtrim(get_class($this), 'Controller'));
    }
    
    public function mainAction($item_form = NULL) {
        parent::mainAction($item_form);
    }
    
    public function getAction() {
        parent::getAction();
    }
    
    public function deleteAction() {
        parent::deleteAction();
    }
    
    protected function save($model,$param) {
        parent::save($model, $param);
    }
    
    protected function viewMain($item_form) {
        $params = parent::viewMain();
        $view = new ViewPosts($params['left_bar_items'], $params['table_items'], $item_form);
        $view->getBody();
    }
    
    protected function checkPost() {
        if (!empty($_POST['postname'])){
            return $obj = ['id' =>$_POST['id'], 'postname'=>$_POST['postname']];
        } else {
            $_SESSION['msgs'][0] = 'Вы оставили поле пустым, заполните его';
            $_SESSION['msgs'][1] = ' red';
            return FALSE;
        }
    }
    
    
}
