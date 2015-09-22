<?php

class ExitController implements IController {
    
    public function mainAction() {
        session_destroy();
        header("Location: /index/main");
    }
    
}
