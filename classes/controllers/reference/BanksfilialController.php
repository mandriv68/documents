<?php

class BanksfilialController extends AbstractRefController implements IController {
                    
    protected $_fc;
    protected $model;


    public function __construct() {
        $this->_fc = FrontController::getInstance();
        $this->model =(rtrim(get_class($this), 'Controller')).'Model';
    }
    
    public function mainAction($item_form = NULL) {
        parent::mainAction($item_form);
    }
    
    public function getAction() {
        parent::getAction($this->model);
    }
    
    public function deleteAction() {
        parent::deleteAction($this->model);
    }
    
    protected function save($fabric_method,$param) {
        parent::save($fabric_method, $param, $this->model);
    }
    
    protected function viewMain($item_form) {
        $left_bar_items = Config::getReferenceConfig();
//  получаем список форм собственности
        $arr_banks = $this->getItemArray($item_form->bank, 'BanksModel');
        if (!is_object($item_form)) {$item_form = (object)[];}
        $item_form->bank = $arr_banks;
        $table_items = BanksfilialModel::factory('all');
        $view = new ViewBanksfilial($left_bar_items, $table_items, $item_form);
        $view->getBody();
    }
    
    protected function checkPost() {
        if (!empty($_POST['name']) && !empty($_POST['bank'])){
            return $obj = [ 'id' =>$_POST['id'],
                            'name'=>$_POST['name'],
                            'bank'=>$_POST['bank'],
                            'banks_bic'=>$_POST['banks_bic']];
        } else {
            $_SESSION['msgs'][0] = 'Вы оставили поле пустым, заполните его';
            $_SESSION['msgs'][1] = ' red';
            return FALSE;
        }
    }
    
}
