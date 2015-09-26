<?php

class ViewDoc extends AbstractView {
     
    protected function getContent() {
?>
<div class="row">
    <? $this->getLeftBar();?>
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-4 orange">
                <h4 style="margin: 0 auto;"><?= ($_SESSION['company_name']) ? $_SESSION['company_name'] : 'выберите фирму'?></h4>
            </div>
            <div class="col-md-8">
                <? $this->getCompanyName()?>
            </div>
        </div>
        <div class="row" style="padding: 0 15px;"><div class="col-md-12 divider"></div></div>
        <div class="row">
<?php       foreach ($this->itemsLeftBar as $controller => $item):
?>
            <div class="col-md-3">
                <a href="/<?= $controller;?>/main">
                    <img src="../../../images/<?= $controller;?>.png" alt="...">
                </a>
            </div>
<?php       endforeach;?>
        </div>
    </div>
</div>

<?php
    }
    
    protected function getCompanyName() {
?>
        <div class="row">
            <div class="col-md-12 bottom15">
                <form role="form" class="form-horizontal" method="post">
                        <span class="col-md-9">    
                            <select name="company" class="form-control input-sm">
                                <option value="0">выберите или измените фирму</option>
<?php       foreach ($this->item_form as $company):
                if ($company->flag):
?>                    
                                <option value="<?= $company->edrpou?>">
                                    <?= $company->ownershipabbr.' '.$company->namecompany.'::'.$company->edrpou?>
                                </option>
               
<?php           endif;    
            endforeach;
?>
                            </select>
                        </span>
                        <span class="col-md-3">
                            <button type="submit" class="btn btn-red btn-sm">Выбрать</button>
                        </span>
                </form>
            </div>
        </div>
<?php
    }
    
    public function getBody() {
        $this->getHeader();
        $this->getNavbar(TRUE);
        $this->getContent();
        $this->getFooter();
    }
    
}
