<?php

class BankaccountsController extends AbstractRefController implements IController {
                
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
        $arr_status = $this->getItemArray($item_form->status, 'AccountstatusModel');
        $arr_currency = $this->getItemArray($item_form->currency, 'CurrencyModel');
        $arr_banks = $this->getItemArray($item_form->bank, 'BanksModel');
        $arr_company = $this->getItemArray($item_form->company, 'CompanyModel');
        if (!is_object($item_form)) {$item_form = (object)[];}
        $item_form->status = $arr_status;
        $item_form->currency = $arr_currency;
        $item_form->bank = $arr_banks;
        $item_form->company = $arr_company;
        $table_items = BankaccountsModel::factory('all');
        $view = new ViewBankaccounts($left_bar_items, $table_items, $item_form);
        $view->getBody();
    }
    
    protected function checkPost() {
        if (!empty($_POST['numberaccount']) && !empty($_POST['status']) && !empty($_POST['currency']) && !empty($_POST['bank']) && !empty($_POST['company'])){
            return $obj = [ 'id' =>$_POST['id'],
                            'numberaccount'=>$_POST['numberaccount'],
                            'status'=>$_POST['status'],
                            'currency'=>$_POST['currency'],
                            'bank'=>$_POST['bank'],
                            'company'=>$_POST['company'],
                            'company_edrpou'=>$_POST['company_edrpou'],
                            'accountstatus_id'=>$_POST['accountstatus_id'],
                            'currency_id'=>$_POST['currency_id'],
                            'banks_bic'=>$_POST['banks_bic']];
        } else {
            $_SESSION['msgs'][0] = 'Вы оставили поле пустым, заполните его';
            $_SESSION['msgs'][1] = ' red';
            return FALSE;
        }
    }
    
    protected function getItemArray($selected,$model) {
        $result = $model::factory('all');
        $array = [];
        $i = 0;
        foreach ($result as $obj) {
            $arr_obj = (array)$obj;
            foreach ($arr_obj as $k=>$v){
                $array[$i][$k] = $v;
            }
            $array[$i]['selected'] = ($arr_obj['id'] == $selected) ? ' selected'  : '';
            $i++;
        }
        return $array;
    }
    
}
