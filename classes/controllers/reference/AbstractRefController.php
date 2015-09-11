<?php

abstract class AbstractRefController {
    
    public function mainAction($item_form = NULL) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $item_form = $this->checkPost();
            if ($item_form) {
                $model = (!empty($item_form['id'])) ? 'update' : 'insert';
                $res = $this->save($model,$item_form);
            }
        }
        $this->viewMain($item_form);
    }
    
    public function getAction() {
        $model = 'get';
        $params = $this->_fc->getParams();
        if (array_key_exists('id', $params)) {
            ReferenceModel::setParams($this->_table);
            $res = ReferenceModel::refFactory($model, $params);
        }
        if ($res) $this->mainAction($res);
    }
    
    public function deleteAction() {
        $model = 'delete';
        $params = $this->_fc->getParams();
        if (array_key_exists('id', $params)) {
            list($k,$v) = each($params);
            $input_params[':'.$k] = $v;
            ReferenceModel::setParams($this->_table);
            $res = ReferenceModel::refFactory($model, $input_params);
        }
    }
    
    protected function save($model,$param) {
        $input_params = [];
        foreach ($param as $key => $value) {
            $input_params[':'.$key] = $value;
        }
        ReferenceModel::setParams($this->_table);
        return ReferenceModel::refFactory($model, $input_params);
    }
    
    protected function viewMain() {
        $output_param = [];
        $output_param['left_bar_items'] = Config::getReferenceConfig();
        ReferenceModel::setParams($this->_table);
        $output_param['table_items'] = ReferenceModel::refFactory('all');
        return $output_param;
    }
    
}
