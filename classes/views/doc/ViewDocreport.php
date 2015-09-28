<?php

class ViewDocreport extends AbstractView {
    
    protected function getContent() {
?>
<div class="row">
    <? $this->getLeftBar();?>
    <div class="col-md-9">
        <div class="row">
<?php
        if (!$_SESSION['company']) {
            $this->getCompanyName();
        }
        else {
?>
            <div class="col-md-12 orange"><h4><?= $_SESSION['company_name'];?> :: отчёты по электричеству</h4></div>
<?      }?>
        </div>
        <div class="row" style="padding: 0 15px;">
            <div class="col-md-12 divider"></div>
            <div class="col-md-12">
<?      $this->getTable();
        if ($_SESSION['result']):?>
            <p><?= $_SESSION['result']?></p>
<?          unset($_SESSION['result']);
        endif;?>
            </div>
        </div>
    </div>
<?php
    }
    
    protected function getCompanyName() {
?>
            <div class="col-md-8 bottom15">
                <form  name="company" role="form" class="form-horizontal" method="post">
                        <span class="col-md-9">
                            <input type="hidden" name="form" value="company">
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
    protected function getTable() {
?>
        <table class="table table-striped table-bordered">
            <tr bgcolor="grey">
                <th align="center" width="6%">№ п/с</th>
                <th align="center" width="15%">дата</th>
                <th align="center" width="15%">лиц.счёт</th>
                <th align="center" width="20%">нач.показ.</th>
                <th align="center" width="20%">посл.показ.</th>
                <th align="center" width="10%">расход</th>
                <th align="center" width="7%">ред...</th>
                <th align="center" width="7%">уд...</th>
            </tr>
<?      $count = 1;
      Dmp::vdmp($this->items_table);
        foreach ($this->items_table as $line):?>
            <tr onclick="location.href='/docreport/get/id/<?= $line->id;?>';" class="hover-tr">
                <td align="center"><?= $count;?></td>
                <td align="left"><?= $line->dt;?></td>
                <td align="left"><?= $line->num_pers_account;?></td>
                <td align="left"><?= $line->meter_reading_before;?></td>
                <td align="left"><?= $line->meter_reading_after;?></td>
                <td align="left"><?= $line->excpense;?></td>
                <td class="icon-edit">
                    <a href="/docreport/get/id/<?= $line->id?>" title="редактировать">
                        <i class="fa fa-pencil-square-o"></i>
                    </a>
                </td>
                <td class="icon-del">
                    <a href="/docreport/delete/id/<?= $line->id?>" title="удалить">
                        <i class="fa fa-eraser"></i>
                    </a>

                </td>
            </tr>
<?          $count++;
        endforeach;?>   
        </table>
<?php   }
    
    public function getBody() {
        $this->getHeader();
        $this->getNavbar(TRUE);
        $this->getContent();
        $this->getFooter();
    }
    
}
