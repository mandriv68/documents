<?php

abstract class AbstractRefController {
    
    public function mainAction($item_form = NULL) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $item_form = $this->checkPost();
            if ($item_form) {
                $fabric_method = (!empty($item_form['id'])) ? 'update' : 'insert';
                $res = $this->save($fabric_method,$item_form);
            }
        }
        $this->viewMain($item_form);
    }
    
    public function getAction($model) {
        Dmp::prnt($model);
        $fabric_method = 'get';
        $params = $this->_fc->getParams();
        if (array_key_exists('id', $params)) {
            $res = $model::factory($fabric_method, $params);
        }
        if ($res) {
            $this->mainAction($res);
        }
    }
    
    public function deleteAction($model) {
        $fabric_method = 'delete';
        $params = $this->_fc->getParams();
        if (array_key_exists('id', $params)) {
            list($k,$v) = each($params);
            $input_params[':'.$k] = $v;
            $res = $model::factory($fabric_method, $input_params);
        }
    }
    
    protected function save($fabric_method, $param, $model) {
        $input_params = [];
        foreach ($param as $key => $value) {
            $input_params[':'.$key] = $value;
        }
        return $model::factory($fabric_method, $input_params);
    }
    
    protected function viewMain($model) {
        $output_param = [];
        $output_param['left_bar_items'] = Config::getReferenceConfig();
        $output_param['table_items'] = $model::factory('all');
        return $output_param;
    }
    
}
