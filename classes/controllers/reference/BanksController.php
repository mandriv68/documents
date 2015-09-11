<?php


class BanksController extends AbstractRefController implements IController {
            
    protected $_fc;
    protected $_table;


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
        } else $item_form = (object)[];
        $this->viewMain($item_form);
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
        $params = [];
        $left_bar_items = Config::getReferenceConfig();
//  получаем список форм собственности
        $selected_ownership = $item_form->ownership;
        ReferenceModel::setParams('ownership');
        $ownership = ReferenceModel::refFactory('all');
        $arr_own = [];
        $i = 0;
        foreach ($ownership as $obj) {
            $arr_own[$i]['id'] = $obj->id;
            $arr_own[$i]['abbr'] = $obj->abbr;
            $arr_own[$i]['selected'] = ($obj->id == $selected_ownership) ? ' selected'  : '';
            $i++;
        }
        $item_form->ownership = $arr_own;
        $table_items = BanksModel::factory('all');
        Dump::vardump($table_items);die;
        $view = new ViewBanks($left_bar_items, $table_items, $item_form);
        $view->getBody();
    }
    
    protected function checkPost() {
        if (!empty($_POST['bic']) && !empty($_POST['ownership']) && !empty($_POST['namebank']) && !empty($_POST['adress'])){
            return $obj = ['id' =>$_POST['id'],'bic'=>$_POST['bic'],'ownership'=>$_POST['ownership'],'namebank'=>$_POST['namebank'],'adress'=>$_POST['adress']];
        } else {
            $_SESSION['msgs'][0] = 'Вы оставили поле пустым, заполните его';
            $_SESSION['msgs'][1] = ' red';
            return FALSE;
        }
    }
    
}