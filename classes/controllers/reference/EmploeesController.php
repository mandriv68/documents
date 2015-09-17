<?php

class EmploeesController extends AbstractRefController implements IController {
                    
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
        $model = $this->model;
        $left_bar_items = Config::getReferenceConfig();
//  готовим массивы для select-ов
        $arr_posts = $this->getItemArray($item_form->post, 'PostsModel');
        $arr_company = $this->getItemArray($item_form->company, 'CompanyModel');
        if (!is_object($item_form)) {$item_form = (object)[];}
        $item_form->post = $arr_posts;  // select name->post
        $item_form->company = $arr_company;  // select name->company
        $table_items = $model::factory('all');
        $view = new ViewEmploees($left_bar_items, $table_items, $item_form);
        $view->getBody();
    }
    
    protected function checkPost() {
        if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['itnl']) && !empty($_POST['company']) && !empty($_POST['post'])){
            return $obj = [ 'id' =>$_POST['id'],
                            'firstname'=>$_POST['firstname'],
                            'lastname'=>$_POST['lastname'],
                            'pasport'=>$_POST['pasport'],
                            'itnl'=>$_POST['itnl'],
                            'company'=>$_POST['company'],
                            'post'=>$_POST['post'],
                            'company_edrpou'=>$_POST['company_edrpou'],
                            'posts_id'=>$_POST['posts_id']];
        } else {
            $_SESSION['msgs'][0] = 'Вы оставили поле пустым, заполните его';
            $_SESSION['msgs'][1] = ' red';
            return FALSE;
        }
    }
    
}
