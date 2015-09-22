<?php

class DocController implements IController{
    
    private $_fc;
    
    public function __construct() {
        $this->_fc = FrontController::getInstance();
    }
    
    public function MainAction() {
        $items = Config::getDocConfig();
        $company = CompanyModel::factory('all');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            foreach ($company as $obj) {
                if ($obj->edrpou == $_POST['company']) {
                    $_SESSION['company_name'] = $obj->ownershipabbr.' '.$obj->namecompany;
                    $_SESSION['company'] = $_POST['company'];
                } else $obj->selected = '';
            }
        }
        $view = new ViewDoc($items,NULL,$company);
        $view->getBody();
    }
}
