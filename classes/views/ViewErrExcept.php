<?php

class ViewErrExcept extends AbstractView {
    
    private $err = [];
    
    public function __construct($errArray) {
        $this->err = $errArray;
    }
    
    public function getContent() {
?>
            <table class="table table-bordered row">
                <tr>
                    <td colspan="3" class="col-lg-12" style="background-color: orange;"><b>сообщение  </b><?=$this->err['msg'];?> <b>(code<?=$this->err['code'];?>)  в файле  </b><?=$this->err['file']?> <b>(стр.<?=$this->err['line']?>)</b></td> 
                </tr>
                <tr>
                    <td colspan="3">стек вызовов</td>
                </tr>
                <tr style="background-color: #ccc">
                    <td align="center" width="20px"><b>#</b></td>
                    <td align="center" width="280px"><b>функция</b></td>
                    <td align="center"><b>файл(№ строки)</b></td>
                </tr>
<?php  
        $i = 0;
        foreach ($this->err['trace'] as $trace): 
            $num = '#'.$i++;
            $class = $function = $type = $file = $line = ''; $args = [];
            foreach ($trace as $key => $value):
                switch ($key) {
                    case 'class':    $class = $value; break;
                    case 'function': $function = $value; break;
                    case 'type':     $type = $value; break;
                    case 'file':     $file = $value; break;
                    case 'line':     $line = $value; break;
                    case 'args':     $args = $value; break;
                }
            endforeach;
?>
                    <tr>
                        <td align="left"><?=$num?></td>
                        <td align="left"><?=$class.$type.$function?></td>
                        <td align="left"><?=$file.'('.$line.')'?></td>
                    </tr>
                    <tr>
                        <td colspan="3" style="background-color: #eee">args ::<?=var_dump($args)?></td>
                    </tr>
<?php   endforeach;?>  
            </table>
<?php
    }
    
    public function getBody() {
        $this->getHeader();
        $this->getNavbar(FALSE);
        $this->getContent();
        $this->getFooter();
    }
}
