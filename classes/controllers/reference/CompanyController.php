<?php

class CompanyController extends AbstractRefController implements IController{
            
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
        $arr_ownership = $this->getItemArray($item_form->ownership, 'OwnershipModel');
        if (!is_object($item_form)) {$item_form = (object)[];}
        $item_form->ownership = $arr_ownership;
        $checked = ($item_form->flag) ? ' checked' : '';
        $arr_checkbox = ['flag'=>$item_form->flag, 'checked'=>$checked];
        $item_form->flag = $arr_checkbox;
        $table_items = CompanyModel::factory('all');
        $view = new ViewCompany($left_bar_items, $table_items, $item_form);
        $view->getBody();
    }
    
    protected function checkPost() {
        if (!empty($_POST['edrpou']) && !empty($_POST['namecompany']) && !empty($_POST['regoffice']) && !empty($_POST['postaladress'])){
            return $obj = ['id' =>$_POST['id'],
                           'edrpou'=>$_POST['edrpou'],
                           'ownership'=>$_POST['ownership'],
                           'namecompany'=>$_POST['namecompany'],
                           'flag'=>$_POST['flag'],
                           'regoffice'=>$_POST['regoffice'],
                           'postaladress'=>$_POST['postaladress'],
                           'vat'=>$_POST['vat'],
                           'itn'=>$_POST['itn'],
                           'sert_of_vat'=>$_POST['sert_of_vat'],
                           'ownership_id'=>$_POST['ownership_id']];
        } else {
            $_SESSION['msgs'][0] = 'Вы оставили поле пустым, заполните его';
            $_SESSION['msgs'][1] = ' red';
            return FALSE;
        }
    }
    
}
