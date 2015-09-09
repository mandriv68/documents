<?php
class ReferenceController implements IController {
    
    private $_fc;
    
    public function __construct() {
        $this->_fc = FrontController::getInstance();
    }
    
    public function mainAction() {
//        $model = $this->_fc->getParams['model'];
//        $model_name = ucfirst($model).'Model';
        $items = Config::getReferenceConfig();
        $view = new ViewReference($items);
        $view->getBody();
    }
    
    protected function checkPost() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
            $post = &$_POST;
        return $post;
    }
}
