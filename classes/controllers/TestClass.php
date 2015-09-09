<?php

class TestClass implements IController {
    
    public function mainAction() {
        $i = 1;
        for ($index = 0; $index < 5; $index++) {
            $i *=$index;
            echo $i;
        }
        
    }
    
}
