<?php

class ViewDocreport extends AbstractView {
    
    protected function getContent() {
?>
<div class="row">
    <? $this->getLeftBar();?>
    <div class="col-md-9">
        <div class="row">
<?php
        if (!$_SESSION['company']) { $this->getCompanyName();}
        else {
?>
            <div class="col-md-12 orange"><h4><?= $_SESSION['company_name'];?> :: отчёты по электричеству</h4></div>
<?      }?>
        </div>
        <div class="row" style="padding: 0 15px;"><div class="col-md-12 divider"></div></div>
    </div>
<?php
    }
    
    protected function getCompanyName() {
?>
            <div class="col-md-8 bottom15">
                <form role="form" class="form-horizontal" method="post">
                        <span class="col-md-9">    
                            <select name="company" class="form-control input-sm">
                                <option class="orange" value="0">выберите фирму для продолжения работы</option>
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
<?php
    }
    
    public function getBody() {
        $this->getHeader();
        $this->getNavbar(TRUE);
        $this->getContent();
        $this->getFooter();
    }
    
}
