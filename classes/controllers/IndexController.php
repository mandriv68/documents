<?php

class IndexController implements IController 
{
    public function mainAction() {
        $items = Config::getSectionsConfig();
        $company = CompanyModel::factory('all');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            foreach ($company as $obj) {
                if ($obj->edrpou == $_POST['company']) {
                    $obj->selected = ' selected';
                    $_SESSION['company_name'] = $obj->ownershipabbr.' '.$obj->namecompany;
                    $_SESSION['company'] = $_POST['company'];
                } else $obj->selected = '';
            }
        }
        $view = new ViewMain($items,NULL,$company);
        $view->getBody();
    }
}
