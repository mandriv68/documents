<?php

class PostsController implements IController {
    
    private $_fc;
    private $_table = 'posts';


    public function __construct() {
        $this->_fc = FrontController::getInstance();
//        $this->_table = strtolower(rtrim(get_class($this), 'Controller'));
    }
    
    public function mainAction($item_form = NULL) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $item_form = $this->checkPost();
            if ($item_form) {
                $model = (!empty($item_form['id'])) ? 'update' : 'insert';
                $this->save($model,$item_form);
            }
        } //else {
//            $item_form = (object)[];
//        }
//        Dump::vardump($item_form); die;
        $this->viewMainPosts($item_form);
    }
    
    public function getpostAction() {
        $model = 'get';
        $params = $this->_fc->getParams();
        if (array_key_exists('id', $params)) {
            ReferenceModel::setParams($this->_table);
            $res = ReferenceModel::refFactory($model, $params);
        }
        if ($res) $this->mainAction($res);
    }
    
    public function deleteAction() {
        $model = 'delete';
        $params = $this->_fc->getParams();
        if (array_key_exists('id', $params)) {
            list($k,$v) = each($params);
            $input_params[':'.$k] = $v;
            ReferenceModel::setParams($this->_table);
            $res = ReferenceModel::refFactory($model, $input_params);
        }
    }
    
    private function save($model,$param) {
        $input_params = [];
        foreach ($param as $key => $value) {
            $input_params[':'.$key] = $value;
        }
        ReferenceModel::setParams($this->_table);
        $res = ReferenceModel::refFactory($model, $input_params);
    }
    
    private function viewMainPosts($item_form) {
        $left_bar_items = Config::getReferenceConfig();
        ReferenceModel::setParams($this->_table);
        $table_items = ReferenceModel::refFactory('all');
        $view = new ViewPosts($left_bar_items, $table_items, $item_form);
        $view->getBody();
        unset($_SESSION['msgs']);
    }
    
    private function checkPost() {
        if (!empty($_POST['postname'])){
            return $obj = ['id' =>$_POST['id'], 'postname'=>$_POST['postname']];
        } else {
            $_SESSION['msgs'][0] = 'Вы оставили поле пустым, заполните его';
            $_SESSION['msgs'][1] = ' red';
            return FALSE;
        }
    }
    
    
}
