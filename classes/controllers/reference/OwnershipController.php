<?php

class OwnershipController implements IController {
    
    private $_fc;
    private $_table;


    public function __construct() {
        $this->_fc = FrontController::getInstance();
        $this->_table = strtolower(rtrim(get_class($this), 'Controller'));
    }
    
    public function mainAction($item_form = NULL) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $item_form = $this->checkPost();
            if ($item_form) {
                $model = (!empty($item_form['id'])) ? 'update' : 'insert';
                $res = $this->save($model,$item_form);
            }
        }
        $this->viewMain($item_form);
    }
    
    public function getAction() {
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
        return ReferenceModel::refFactory($model, $input_params);
    }
    
    private function viewMain($item_form) {
        $left_bar_items = Config::getReferenceConfig();
        ReferenceModel::setParams($this->_table);
        $table_items = ReferenceModel::refFactory('all');
        $view = new ViewOwnership($left_bar_items, $table_items, $item_form);
        $view->getBody();
    }
    
    private function checkPost() {
        if (!empty($_POST['abbr']) && !empty($_POST['description'])){
            return $obj = ['id' =>$_POST['id'],'abbr'=>$_POST['abbr'],'description'=>$_POST['description']];
        } else {
            $_SESSION['msgs'][0] = 'Вы оставили поле пустым, заполните его';
            $_SESSION['msgs'][1] = ' red';
            return FALSE;
        }
    }
    
}
