<?php

class PersonalaccountsController extends AbstractRefController implements IController {
                    
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
        $arr_company = $this->getItemArray($item_form->company, 'CompanyModel');
        if (!is_object($item_form)) {$item_form = (object)[];}
        $item_form->company = $arr_company;
        $table_items = PersonalaccountsModel::factory('all');
        $view = new ViewPersonalaccounts($left_bar_items, $table_items, $item_form);
        $view->getBody();
    }
    
    protected function checkPost() {
        if (!empty($_POST['numberaccount']) && !empty($_POST['contract']) && !empty($_POST['meter']) && !empty($_POST['company'])&& !empty($_POST['accountpurpose'])){
            return $obj = [ 'id' =>$_POST['id'],
                            'numberaccount'=>$_POST['numberaccount'],
                            'contract'=>$_POST['contract'],
                            'meter'=>$_POST['meter'],
                            'company'=>$_POST['company'],
                            'accountpurpose'=>$_POST['accountpurpose'],
                            'company_edrpou'=>$_POST['company_edrpou']];
        } else {
            $_SESSION['msgs'][0] = 'Вы оставили поле пустым, заполните его';
            $_SESSION['msgs'][1] = ' red';
            return FALSE;
        }
    }
    
}
