<?php

class ArchivesController implements IController {
    
    private $_fc;
    
    public function __construct() {
        $this->_fc = FrontController::getInstance();
    }
    
    public function MainAction() {
//        $model = $this->_fc->getParams['model'];
//        $model_name = ucfirst($model).'Model';
        $items = Config::getArchivesConfig();
        $view = new ViewReference($items);
        $view->getBody();
    }
}
