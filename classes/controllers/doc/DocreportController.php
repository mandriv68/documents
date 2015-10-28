<?php

class DocreportController implements IController {
    private $_fc;
    
    public function __construct() {
        $this->_fc = FrontController::getInstance();
    }
    
    public function MainAction() {
        $items_leftbar = Config::getDocConfig();
        $item_form = CompanyModel::factory('all');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $item_form = $this->checkPost();
        }
        $items_table = DocreportModel::factory('all');
        $view = new ViewDocreport($items_leftbar,$items_table,$item_form);
        $view->getBody();
    }
    
    private function checkPost() {
        switch ($_POST['form']) {
            case 'company':
                $company = CompanyModel::factory('find_the_edrpou', (int)$_POST['company']);
                $_SESSION['company_name'] = $company->ownershipabbr.' '.$company->namecompany;
                $_SESSION['company'] = $_POST['company'];
                return (object)[];

            case 'doc':
                return $item_form = DocreportModel::factory('get');
        }
    }
    
}

