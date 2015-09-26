<?php

abstract class AbstractView {
    
    protected $itemsLeftBar = [];
    protected $items_table;
    protected $item_form;

    public function __construct($itemLeftBar, $items_table=NULL, $item_form=NULL) {
        $this->itemsLeftBar = $itemLeftBar;
        $this->items_table = $items_table;
        $this->item_form = $item_form;
    }
    
    protected function getHeader() {
        echo <<<HTML_ENTITIES
<!DOCTYPE HTML>
<html>
<head>
    <title>Documents</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/../../css/bootstrap.min.css" >
    <link rel="stylesheet" href="/../../css/font-awesome.min.css" >
    <link rel="stylesheet" href="/../../css/yourstyle.css" >
    <script src="/../../js/respond.min.js"></script>
</head>
 
    <body>
        <div class="container">
HTML_ENTITIES;
    }
    
    protected function getFooter() {
        echo <<<HTML_ENTITIES
            <!-- JS код -->
            <script src="http://code.jquery.com/jquery-latest.min.js"></script>
            <script src="/../../js/bootstrap.min.js"></script>
        </div>
    </body>
</html>
HTML_ENTITIES;
    }
    
    protected function getNavbar($flag) {
        echo <<<HTML_ENTITIES1
        <div class="row">
            <div class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="brand-company">{$_SESSION['company_name']}</div>
                        <a class="navbar-brand" href="/index/main">
                            <i class="fa fa-folder-open-o fa-lg orange"></i> ДОКУМЕНТЫ
                <!--        <img src="/../../images/doc.png" alt="">   -->
                        </a>
                    <div class="divider-vertical"></div>
HTML_ENTITIES1;
        if ($flag)  {          
                    echo <<<HTML_ENTITIES2
                    <ul class="nav navbar-nav items-top-menu">
                        <li class="active"><a href="/index/main"><span class="glyphicon glyphicon-home orange"></span></a></li>
                        <li><a href="/reference/main">справочники</a></li>
                        <li><a href="/doc/main">документы</a></li>
                        <li><a href="/archives/main">архив</a></li>
                        <li>
                            <a href="/exit/main" class="orange"><i class="fa fa-sign-out"></i>&nbsp выход</a>
                        </li>
                    </ul>
HTML_ENTITIES2;
        }
        echo <<<HTML_ENTITIES3
                </div>
            </div>
        </div>
HTML_ENTITIES3;
    }
    
    protected function getLeftBar() {
        echo <<<HTML_ENTITIES
        <div id="left-bar" class="col-md-3">
            <ul class="nav nav-pills nav-stacked">
HTML_ENTITIES;
        foreach ($this->itemsLeftBar as $controller => $item) {
            list($i_class, $menu_item) = each($item);
            echo '<li class="">'
                    .'<a href="/'.$controller.'/main">'
                        .'<i class="'.$i_class.'"></i>&nbsp&nbsp'.$menu_item.
                     '</a>'.
                 '</li>';
            }
        echo '</ul>'.
        '</div>';
    }
    
    protected function getContent() {
        ?>
<div class="row">
        <? $this->getLeftBar();?>
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-12 bottom15">
        <?= $this->getForm();?>
            </div>
            <div class="col-md-12">
<?      $this->getTable();
        if ($_SESSION['result']):?>
            <p><?= $_SESSION['result']?></p>
<?          unset($_SESSION['result']);
        endif;?>
            </div>
        </div>
    </div>
</div>

<?php
        unset($_SESSION['msgs']);
    }
    
    protected function getCompanyName() {
        $legend = (!$_SESSION['company_name']) ?
                'для работы с документами и архивами выберите фирму':
                'Сейчас Вы работаете с фирмой '.$_SESSION['company_name'];
?>
        <div class="row">
            <div class="col-md-12 bottom15">
                <form role="form" class="form-horizontal" method="post">
                    <fieldset>
                        <legend><?= $legend?></legend>
                        <span class="col-md-9">    
                            <select name="company" class="form-control">
                                <option value="0">выберите название фирмы</option>
<?php       foreach ($this->item_form as $company):
                if ($company->flag):
?>                    
                                <option value="<?= $company->edrpou?>"<?= $company->selected?>>
                                    <?= $company->ownershipabbr.' '.$company->namecompany.'::'.$company->edrpou?>
                                </option>
               
<?php           endif;
            endforeach;
?>
                            </select>
                        </span>
                        <span class="col-md-3">
                            <button type="submit" class="btn btn-red">Выбрать</button>
                        </span>
                    </fieldset>
                </form>
            </div>
        </div>
<?php
    }

    public function getBody() {
        
    }
    
}
