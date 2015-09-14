<?php


class BanksController extends AbstractRefController implements IController {
            
    protected $_fc;
    protected $model;


    public function __construct() {
        $this->_fc = FrontController::getInstance();
        $this->model =(rtrim(get_class($this), 'Controller')).'Model';
    }
    
    public function mainAction($item_form = NULL) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $item_form = $this->checkPost();
            if ($item_form) {
                $fabric_method = (!empty($item_form['id'])) ? 'update' : 'insert';
                $res = $this->save($fabric_method,$item_form);
                if ($res) 
                    {$item_form = (object)[];}
            }
        }
        $this->viewMain($item_form);
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
        $selected_ownership = $item_form->ownership;
        $ownership = OwnershipModel::factory('all');
        $arr_own = [];
        $i = 0;
        foreach ($ownership as $obj) {
            $arr_own[$i]['id'] = $obj->id;
            $arr_own[$i]['abbr'] = $obj->abbr;
            $arr_own[$i]['selected'] = ($obj->id == $selected_ownership) ? ' selected'  : '';
            $i++;
        }
        if (!is_object($item_form)) {$item_form = (object)[];}
        $item_form->ownership = $arr_own;
        $table_items = BanksModel::factory('all');
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
