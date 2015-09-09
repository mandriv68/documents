<?php

class IndexController implements IController 
{
    public function mainAction() {
        $items = Config::getSectionsConfig();
        $view = new ViewMain($items);
        $view->getBody();
    }
}
