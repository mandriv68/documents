<?php

class MyException extends Exception {
    
    public function __construct($message, $code = 0) {
        // some code
    
        // make sure everything is assigned properly
        parent::__construct($message, $code);
    }
    
    public function getException() {
        $err = [];
        $err['msg'] = $this->getMessage();
        $err['code'] = $this->getCode();
        $err['file'] = $this->getFile();
        $err['line'] = $this->getLine();
        $err['trace'] = $this->getTrace();
        $view = new ViewErrExcept($err);
        $view->getBody();
    }
    
}
