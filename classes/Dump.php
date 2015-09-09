<?php

class Dump {

    public static function vardump($val1, $val2 = 0, $val3 = 0, $val4 = 0)  {
        echo '<pre>';
        $arr = [$val1, $val2, $val3, $val4];
        foreach ($arr as $value) {
            if ($value) var_dump($value);
        }
        echo '</pre>';
    }
    
    public static function prnt($val1, $val2 = 0, $val3 = 0, $val4 = 0) {
        echo '<pre>';
        $arr = [$val1, $val2, $val3, $val4];
        foreach ($arr as $value) {
            if ($value) print_r($value);
        }
        echo '</pre>';
    }
    
}
